<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use DB;
use Cart;
use Mail;
use App\Mail\ContactFormMail;

class IndexController extends Controller
{
    //root page
    public function index()
    {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $brand=DB::table('brands')->where('front_page',1)->limit(24)->get();
        $bannerproduct=Product::where('status',1)->where('product_slider',1)->orderBy('id','DESC')->limit(3)->get();
        $featured=Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(16)->get();
        $todaydeal=Product::where('status',1)->where('today_deal',1)->orderBy('id','DESC')->limit(6)->get();
        $popular_product=Product::where('status',1)->orderBy('product_views','DESC')->limit(16)->get();
        $trendy_product=Product::where('status',1)->where('trendy',1)->orderBy('id','DESC')->limit(8)->get();
        $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
        $review = DB::table('wbreviews')
                    ->join('users', 'wbreviews.user_id', '=', 'users.id')
                    ->select('wbreviews.*', 'users.user_photo')
                    ->get();        
        //homepage category
        $home_category=DB::table('categories')->where('home_page',1)->orderBy('category_name','ASC')->get();
        $content=Cart::content();

        $campaign=DB::table('campaigns')->where('status',1)->limit(3)->get();

        return view('frontend.index',compact('category','bannerproduct','featured','popular_product','trendy_product','home_category','brand','random_product','todaydeal','campaign','review','content'));
    }

    //singleproduct page calling method
    public function ProductDetails($slug)
    {
        $categories=DB::table('categories')->get();
        $product=Product::where('slug',$slug)->first();
        Product::where('slug',$slug)->increment('product_views');
        $review=Review::where('product_id',$product->id)->orderBy('id','DESC')->take(6)
                    ->join('users', 'reviews.user_id', '=', 'users.id')
                    ->select('reviews.*', 'users.user_photo')
                    ->get();
        $totalReviews = $review->count();  // Get the total number of reviews
        $related_product=DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','DESC')->take(10)->get();
        $brand=DB::table('brands')->get();
        $content=Cart::content();
        $trendy_product=Product::where('status',1)->where('trendy',1)->orderBy('id','DESC')->limit(3)->get();
        $campaign=DB::table('campaigns')->where('status',1)->limit(1)->get();
        return view('frontend.product.product_details',compact('product','related_product','review','brand','content','totalReviews','categories','trendy_product','campaign'));
    }

    //product quick view
    public function ProductQuickView($id)
    {
        $product=Product::where('id',$id)->first();
        return view('frontend.product.quick_view',compact('product'));
    }


    //categorywise product page
    public function categoryWiseProduct($id)
    {
        $category=DB::table('categories')->where('id',$id)->first();
        $subcategory=DB::table('subcategories')->where('category_id',$id)->get();
        $brand=DB::table('brands')->get();
        $products=DB::table('products')->where('category_id',$id)->paginate(12);
        $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
        $content=Cart::content();
        return view('frontend.product.category_products',compact('subcategory','brand','products','random_product','category','content'));

    }

    //subcategorywise product
    public function SubcategoryWiseProduct($id)
    {
        $subcategory=DB::table('subcategories')->where('id',$id)->first();
        $childcategories=DB::table('childcategories')->where('subcategory_id',$id)->get();
        $brand=DB::table('brands')->get();
        $products=DB::table('products')->where('subcategory_id',$id)->paginate(12);
        $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
        $content=Cart::content();
        return view('frontend.product.subcategory_product',compact('childcategories','brand','products','random_product','subcategory','content'));
    }

    //childcategory product
    public function ChildcategoryWiseProduct($id)
    {
        $childcategory=DB::table('childcategories')->where('id',$id)->first();
        $categories=DB::table('categories')->get();
        $brand=DB::table('brands')->get();
        $products=DB::table('products')->where('childcategory_id',$id)->paginate(12);
        $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
        $content=Cart::content();
        return view('frontend.product.childcategory_product',compact('categories','brand','products','random_product','childcategory','content'));
    }

    //brandwise product
    public function BrandWiseProduct($id)
    {
        $brand=DB::table('brands')->where('id',$id)->first();
        $categories=DB::table('categories')->get();
        $brands=DB::table('brands')->get();
        $products=DB::table('products')->where('brand_id',$id)->paginate(12);
        $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
        $content=Cart::content();
        return view('frontend.product.brandwise_product',compact('categories','brands','products','random_product','brand','content'));
    }

    //page view method
    public function ViewPage($page_slug)
    {
        $page=DB::table('pages')->where('page_slug',$page_slug)->first();
        return view('frontend.page',compact('page'));
    }

    //store newsletter
    public function storeNewsletter(Request $request)
    {
        $email=$request->email;
        $check=DB::table('newsletters')->where('email',$email)->first();
        if ($check) {
            return response()->json('Email Already Exist!');
        }else{
              $data=array();
              $data['email']=$request->email;
              DB::table('newsletters')->insert($data);
              return response()->json('Thanks for subscribe us!');  
        }
       

    }


    //__order tracking page
    public function OrderTracking()
    {
        return view('frontend.order_tracking');
    }
   
   
    //__check orer
    public function CheckOrder(Request $request)
    {
        $check=DB::table('orders')->where('order_id',$request->order_id)->first();
        if ($check) {
            $order=DB::table('orders')->where('order_id',$request->order_id)->first();
            $order_details=DB::table('order_details')->where('order_id',$order->id)->get();
            return view('frontend.order_details',compact('order','order_details'));
        }else{
            $notification=array('messege' => 'Invalid OrderID! Try again.', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    //__blog page
    public function Blog()
    {
        return view('frontend.blog');
    }

    //__campaign products__//
    public function CampaignProduct($id)
    {
        $products=DB::table('campaign_product')->leftJoin('products','campaign_product.product_id','products.id')
                    ->select('products.name','products.code','products.thumbnail','products.slug','campaign_product.*')
                    ->where('campaign_product.campaign_id',$id)
                    ->paginate(12);        
        $content=Cart::content();
        return view('frontend.campaign.product_list',compact('products','content'));
    }

    

    //__campaign product details__//
    public function CampaignProductDetails($slug)
    {
        $product=Product::where('slug',$slug)->first();
                Product::where('slug',$slug)->increment('product_views');
        $product_price=DB::table('campaign_product')->where('product_id',$product->id)->first();         
        $related_product=DB::table('campaign_product')->leftJoin('products','campaign_product.product_id','products.id')
                    ->select('products.name','products.code','products.thumbnail','products.slug','campaign_product.*')
                    ->inRandomOrder(12)->get();
        $review=Review::where('product_id',$product->id)->orderBy('id','DESC')->take(6)->get();
        return view('frontend.campaign.product_details',compact('product','related_product','review','product_price'));
    }

    public function login()
    {
        
        $content=Cart::content();
        return view('frontend.profile.login',compact('content'));
    }
    public function register()
    {
        $content=Cart::content();
        return view('frontend.profile.register',compact('content'));
    }

    //constact page
    public function Contact()
    {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $content=Cart::content();

        return view('frontend.contact',compact('category','content'));
    }

    public function submitContactForm(Request $request)
    {
        // Validate the form data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Send email
        Mail::to('admin@example.com')->send(new ContactFormMail($data));

        // Redirect back with success message
        
        $notification = array('messege' => 'Your message has been sent successfully!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

}
