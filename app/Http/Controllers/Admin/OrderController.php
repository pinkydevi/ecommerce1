<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Mail\RecievedMail;
use Mail;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__order list
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imgurl='files/product';

            $product="";
              $query=DB::table('orders')->orderBy('id','DESC');
                if ($request->payment_type) {
                    $query->where('payment_type',$request->payment_type);
                }

                if ($request->date) {
                    $order_date=date('d-m-Y',strtotime($request->date));
                    $query->where('date',$order_date);
                }

                if ($request->status==0) {
                    $query->where('status',0);
                }
                if ($request->status==1) {
                    $query->where('status',1);
                }
                if ($request->status==2) {
                    $query->where('status',2);
                }
                if ($request->status==3) {
                    $query->where('status',3);
                }
                if ($request->status==4) {
                    $query->where('status',4);
                }
                if ($request->status==5) {
                    $query->where('status',5);
                }
               

            $product=$query->get();
            return DataTables::of($product)
                    ->addIndexColumn()
                    ->editColumn('status',function($row){
                        if ($row->status==0) {
                            return '<span class="badge badge-danger">Pending</span>';
                        }elseif($row->status==1){
                            return '<span class="badge badge-primary">Recieved</span>';
                        }elseif($row->status==2){
                            return '<span class="badge badge-info">Shipped</span>';
                        }elseif($row->status==3){
                            return '<span class="badge badge-success">Completed</span>';
                        }elseif($row->status==4){
                            return '<span class="badge badge-warning">Return</span>';
                        }elseif($row->status==5){
                            return '<span class="badge badge-danger">Cancel</span>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn='
                        <a href="#" data-id="'.$row->id.'" class="btn btn-primary btn-sm view" data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye"></i></a>
                        <a href="#" data-id="'.$row->id.'" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a> 
                        <a href="'.route('order.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);       
        }

        return view('admin.order.index');
    }


    //__order edit
    public function Editorder($id)
    {
        $order=DB::table('orders')->where('id',$id)->first();
        return view('admin.order.edit',compact('order'));
    }

    //__update status
    public function updateStatus(Request $request)
    {
        $data=array();
        $data['c_name']=$request->c_name;
        $data['c_email']=$request->c_email;
        $data['c_address']=$request->c_address;
        $data['c_phone']=$request->c_phone;
        $data['status']=$request->status;

        if($request->status=='1'){
            Mail::to($request->c_email)->send(new RecievedMail($data));
        }
        
        DB::table('orders')->where('id',$request->id)->update($data);
        return response()->json('successfully update status!');
    }


    //__view Order
    public function ViewOrder($id)
    {
        $order=DB::table('orders')->where('id',$id)->first();
        $order_details=DB::table('order_details')->where('order_id',$id)->get();
        return view('admin.order.order_details',compact('order','order_details'));
    }

    //__delete
    public function delete($id)
    {
       $order=DB::table('orders')->where('id',$id)->delete();
       $order_details=DB::table('order_details')->where('order_id',$id)->delete();
       $notification=array('messege' => 'Order deleted!', 'alert-type' => 'success');
       return redirect()->back()->with($notification);
    }

    //__report index__//
    public function Reportindex(Request $request)
    {
         if ($request->ajax()) {
            $imgurl='files/product';

            $product="";
              $query=DB::table('orders')->orderBy('id','DESC');
                if ($request->payment_type) {
                    $query->where('payment_type',$request->payment_type);
                }

                if ($request->date) {
                    $order_date=date('d-m-Y',strtotime($request->date));
                    $query->where('date',$order_date);
                }

                if ($request->status==0) {
                    $query->where('status',0);
                }
                if ($request->status==1) {
                    $query->where('status',1);
                }
                if ($request->status==2) {
                    $query->where('status',2);
                }
                if ($request->status==3) {
                    $query->where('status',3);
                }
                if ($request->status==4) {
                    $query->where('status',4);
                }
                if ($request->status==5) {
                    $query->where('status',5);
                }
               

            $product=$query->get();
            return DataTables::of($product)
                    ->addIndexColumn()
                    ->editColumn('status',function($row){
                        if ($row->status==0) {
                            return '<span class="badge badge-danger">Pending</span>';
                        }elseif($row->status==1){
                            return '<span class="badge badge-primary">Recieved</span>';
                        }elseif($row->status==2){
                            return '<span class="badge badge-info">Shipped</span>';
                        }elseif($row->status==3){
                            return '<span class="badge badge-success">Completed</span>';
                        }elseif($row->status==4){
                            return '<span class="badge badge-warning">Return</span>';
                        }elseif($row->status==5){
                            return '<span class="badge badge-danger">Cancel</span>';
                        }
                    })
                    ->rawColumns(['status'])
                    ->make(true);       
        }

        return view('admin.report.index');
    }

    //order print__
    public function ReportOrderPrint(Request $request)
    {
        if ($request->ajax()) {
            $order="";
              $query=DB::table('orders')->orderBy('id','DESC');
                if ($request->payment_type) {
                    $query->where('payment_type',$request->payment_type);
                }

                if ($request->date) {
                    $order_date=date('d-m-Y',strtotime($request->date));
                    $query->where('date',$order_date);
                }

                if ($request->status==0) {
                    $query->where('status',0);
                }
                if ($request->status==1) {
                    $query->where('status',1);
                }
                if ($request->status==2) {
                    $query->where('status',2);
                }
                if ($request->status==3) {
                    $query->where('status',3);
                }
                if ($request->status==4) {
                    $query->where('status',4);
                }
                if ($request->status==5) {
                    $query->where('status',5);
                }     
            $order=$query->get();
       }

       return view('admin.report.print',compact('order'));
    }

    //__product report index__//
    public function ProductReviewReportIndex(Request $request)
    {
        if ($request->ajax()) {
            $imgurl='files/product';

            $product="";
            $query = DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->orderBy('reviews.id', 'DESC');
            

            // ->select('reviews.user_id', 'users.name as user_name')

            if ($request->predicted_emotion==0) {
                $query->where('predicted_emotion',0);
            }
            if ($request->predicted_emotion==1) {
                $query->where('predicted_emotion',1);
            }
            if ($request->predicted_emotion==2) {
                $query->where('predicted_emotion',2);
            }
            if ($request->predicted_emotion==3) {
                $query->where('predicted_emotion',3);
            }
            if ($request->predicted_emotion==4) {
                $query->where('predicted_emotion',4);
            }
            if ($request->predicted_emotion==5) {
                $query->where('predicted_emotion',5);
            }
            if ($request->predicted_emotion==6) {
                $query->where('predicted_emotion',6);
            }
            if ($request->predicted_emotion==7) {
                $query->where('predicted_emotion',7);
            }
            if ($request->predicted_emotion==8) {
                $query->where('predicted_emotion',8);
            }
            if ($request->predicted_emotion==9) {
                $query->where('predicted_emotion',9);
            }
            if ($request->predicted_emotion==10) {
                $query->where('predicted_emotion',10);
            }
            if ($request->predicted_emotion==11) {
                $query->where('predicted_emotion',11);
            }
            if ($request->predicted_emotion==12) {
                $query->where('predicted_emotion',12);
            }
            

            $product = $query->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->editColumn('predicted_emotion', function ($row) {
                    if ($row->predicted_emotion==0) {
                        return '<span class="badge badge-danger">Anger</span>';
                    }elseif ($row->predicted_emotion==1) {
                        return '<span class="badge badge-secondary">Boredom</span>';
                    }elseif ($row->predicted_emotion==2) {
                        return '<span class="badge badge-light">Empty</span>';
                    }elseif ($row->predicted_emotion==3) {
                        return '<span class="badge badge-info">Enthusiasm</span>';
                    }elseif ($row->predicted_emotion==4) {
                        return '<span class="badge badge-primary">Fun</span>';
                    }elseif ($row->predicted_emotion==5) {
                        return '<span class="badge badge-primary">Happiness</span>';
                    }elseif ($row->predicted_emotion==6) {
                        return '<span class="badge badge-danger">Hate</span>';
                    }elseif ($row->predicted_emotion==7) {
                        return '<span class="badge badge-secondary">Love</span>';
                    }elseif ($row->predicted_emotion==8) {
                        return '<span class="badge badge-secondary">Neutral</span>';
                    }elseif ($row->predicted_emotion==9) {
                        return '<span class="badge badge-secondary">Relief</span>';
                    }elseif ($row->predicted_emotion==10) {
                        return '<span class="badge badge-secondary">Sadness</span>';
                    }elseif ($row->predicted_emotion==11) {
                        return '<span class="badge badge-warning">Surprise</span>';
                    }elseif ($row->predicted_emotion==12) {
                        return '<span class="badge badge-warning">Worry</span>';
                    }
                })
                ->rawColumns(['predicted_emotion'])
                ->make(true);     
        }
        return view('admin.report.product_review_index');
    }

    //__product print__
    public function ProductReviewReportPrint(Request $request)
    {
        if ($request->ajax()) {
            $review = "";
            $query = DB::table('reviews')
                ->join('users', 'reviews.user_id', '=', 'users.id')
                ->join('products', 'reviews.product_id', '=', 'products.id')
                ->orderBy('reviews.id', 'DESC');

            if ($request->has('predicted_emotion')) {
                $predicted_emotion = $request->predicted_emotion;
                $query->where('predicted_emotion', $predicted_emotion);
            }

            $review = $query->get();
        }

        return view('admin.report.product_review_print', compact('review'));
    }
    
    













    //__product report index__//
    public function WebReviewReportIndex(Request $request)
    {
        if ($request->ajax()) {
            $imgurl='files/product';

            $product="";
            $query = DB::table('wbreviews')
            ->join('users', 'wbreviews.user_id', '=', 'users.id')
            ->orderBy('wbreviews.id', 'DESC');
            

            // ->select('reviews.user_id', 'users.name as user_name')

            if ($request->predicted_emotion==0) {
                $query->where('predicted_emotion',0);
            }
            if ($request->predicted_emotion==1) {
                $query->where('predicted_emotion',1);
            }
            if ($request->predicted_emotion==2) {
                $query->where('predicted_emotion',2);
            }
            if ($request->predicted_emotion==3) {
                $query->where('predicted_emotion',3);
            }
            if ($request->predicted_emotion==4) {
                $query->where('predicted_emotion',4);
            }
            if ($request->predicted_emotion==5) {
                $query->where('predicted_emotion',5);
            }
            if ($request->predicted_emotion==6) {
                $query->where('predicted_emotion',6);
            }
            if ($request->predicted_emotion==7) {
                $query->where('predicted_emotion',7);
            }
            if ($request->predicted_emotion==8) {
                $query->where('predicted_emotion',8);
            }
            if ($request->predicted_emotion==9) {
                $query->where('predicted_emotion',9);
            }
            if ($request->predicted_emotion==10) {
                $query->where('predicted_emotion',10);
            }
            if ($request->predicted_emotion==11) {
                $query->where('predicted_emotion',11);
            }
            if ($request->predicted_emotion==12) {
                $query->where('predicted_emotion',12);
            }
            

            $product = $query->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->editColumn('predicted_emotion', function ($row) {
                    if ($row->predicted_emotion==0) {
                        return '<span class="badge badge-danger">Anger</span>';
                    }elseif ($row->predicted_emotion==1) {
                        return '<span class="badge badge-secondary">Boredom</span>';
                    }elseif ($row->predicted_emotion==2) {
                        return '<span class="badge badge-light">Empty</span>';
                    }elseif ($row->predicted_emotion==3) {
                        return '<span class="badge badge-info">Enthusiasm</span>';
                    }elseif ($row->predicted_emotion==4) {
                        return '<span class="badge badge-primary">Fun</span>';
                    }elseif ($row->predicted_emotion==5) {
                        return '<span class="badge badge-primary">Happiness</span>';
                    }elseif ($row->predicted_emotion==6) {
                        return '<span class="badge badge-danger">Hate</span>';
                    }elseif ($row->predicted_emotion==7) {
                        return '<span class="badge badge-secondary">Love</span>';
                    }elseif ($row->predicted_emotion==8) {
                        return '<span class="badge badge-secondary">Neutral</span>';
                    }elseif ($row->predicted_emotion==9) {
                        return '<span class="badge badge-secondary">Relief</span>';
                    }elseif ($row->predicted_emotion==10) {
                        return '<span class="badge badge-secondary">Sadness</span>';
                    }elseif ($row->predicted_emotion==11) {
                        return '<span class="badge badge-warning">Surprise</span>';
                    }elseif ($row->predicted_emotion==12) {
                        return '<span class="badge badge-warning">Worry</span>';
                    }
                })
                ->rawColumns(['predicted_emotion'])
                ->make(true);     
        }
        return view('admin.report.web_review_index');
    }

    //__product print__
    public function WebReviewReportPrint(Request $request)
    {
        if ($request->ajax()) {
            $webreviews = "";
            $query = DB::table('wbreviews')
                ->join('users', 'wbreviews.user_id', '=', 'users.id')
                ->orderBy('wbreviews.id', 'DESC');

            if ($request->has('predicted_emotion')) {
                $predicted_emotion = $request->predicted_emotion;
                $query->where('predicted_emotion', $predicted_emotion);
            }

            $webreviews = $query->get();
        }

        return view('admin.report.web_review_print', compact('webreviews'));
    }
}
