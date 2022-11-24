<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Coupon;
use App\Models\CouponsUsed;
use App\Models\OrderDetails;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Mail;

class OrderDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Show Order Details
    public function ShowOrderDetails()
    {
        // $users = User::orderBy('created_at', 'desc')->with('useraddress')->paginate(10);
        $useraddress=UserAddress::orderBy('created_at', 'desc')->with('couponused', 'Orderdetail', 'userorder')->paginate(10);
        return view('Order Details.ShowOrderDetails', compact('useraddress'));
    }

    //To show Details of order
    public function OrderInfo($id)
    {
        $products = Product::with('images', 'assoc')->withTrashed()->get();
        $coupons = Coupon::all();
        $useraddress = UserAddress::with('couponused', 'Orderdetail', 'userorder')->whereId($id)->first();
return $products;
        // return view('Order Details.OrderInfo', compact('useraddress', 'products', 'coupons'));
    }

    //Update Order Details
    public function updateStatus(Request $req){
        OrderDetails::where('id',$req->orderdtlid)->update([
            'status' => $req->status
        ]);
        $userdetails = UserAddress::where('id',$req->userdtlid)->first();
        $orderdetails = OrderDetails::where('id',$req->orderdtlid)->first();

        $data = ['fname' => $userdetails->first_name,'lname' => $userdetails->last_name,'email'=>$userdetails->email,'status'=>$orderdetails->status];
        $user['to'] = $userdetails->email;
        Mail::send('Mail.UpdateOrderStatus',$data,function($message) use ($user){
            $message->to($user['to']);
            $message->subject('Order Update!!');
        });
        return back()->with('status',"Order Updated !! Mail Sent to User");
    }
}
