<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Http;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //review store
    public function store(Request $request)
{
    $validated = $request->validate([
       'rating' => 'required',
       'input_text' => 'required',
   ]);

    $check=DB::table('reviews')->where('user_id',Auth::id())->where('product_id',$request->product_id)->first();

    if ($check) {
       $notification=array('messege' => 'Already you have a review with this product !', 'alert-type' => 'error');
       return redirect()->back()->with($notification); 
    }

    $input_text = $request->input('input_text');

    try {
        $response = Http::post('http://f4a8-34-23-70-202.ngrok-free.app/predict', [
            'input_text' => $input_text,
        ]);

        $responseData = json_decode($response->body(), true);
        $predicted_emotion = $responseData['index']; // Access the 'index' value from the decoded JSON response

         //query builder
        $data=array();
        $data['user_id']=Auth::id();
        $data['product_id']=$request->product_id;
        $data['review']=$input_text;
        $data['rating']=$request->rating;
        $data['predicted_emotion'] = $predicted_emotion; // Save predicted emotion in the database
        $data['review_date']=date('d-m-Y');
        $data['review_month']=date('F');
        $data['review_year']=date('Y');
        DB::table('reviews')->insert($data);

        $notification=array('messege' => 'Thank for your review !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'An error occurred during prediction.']);
    }  
}

   
    //wqrite a review for website
    public function write()
    {
        return view('user.review_write');
    }

    //store website review
    public function StoreWebsiteReview(Request $request)
    {
        $check = DB::table('wbreviews')->where('user_id', Auth::id())->first();
        if ($check) {
            $notification = array('messege' => 'Review already exists!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }

        $input_text = $request->input('input_text');
        try {
            $response = Http::post('http://f4a8-34-23-70-202.ngrok-free.app/predict', [
                'input_text' => $input_text,
            ]);
            $responseData = json_decode($response->body(), true);
            $predicted_emotion = $responseData['index']; // Access the 'index' value from the decoded JSON response

            $data = array();
            $data['user_id'] = Auth::id();
            $data['name'] = $request->name;
            $data['review'] = $input_text;
            $data['rating'] = $request->rating;
            $data['review_date'] = date('d , F Y');
            $data['status'] = 0;
            $data['predicted_emotion'] = $predicted_emotion; // Save predicted emotion in the database

            DB::table('wbreviews')->insert($data);

            $notification=array('messege' => 'Thank for your review !', 'alert-type' => 'success');
            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred during prediction.']);
        }
    }



}
