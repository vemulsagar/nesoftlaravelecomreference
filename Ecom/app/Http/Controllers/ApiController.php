<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Models\Banner;
use App\Models\ContactUs;
use App\Models\Category;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\CouponsUsed;
use App\Models\OrderDetails;
use App\Models\UserAddress;
use App\Models\UserOrder;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Mail;
use Egulias\EmailValidator\Exception\UnclosedComment;
use App\Models\CMSAddress;
use App\Models\CMSHeader;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class ApiController extends Controller
{
    public function Index()
    {
        $user = User::all();
        return response()->json($user);
    }
    public function Login(Request $request)
    {
     try{
            if (!$token = auth()->guard('api')) {
                return response()->json(['err' => 1, 'msg' => 'Credentials does not match']);
            } else {

                $user = User::where('email', $request->email)->first();
                return response()->json([
                    'err' => 0,
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
                    'user' => $user
                ]);
            }
        }
        catch(\Exception $ex){
            return response()->json(['err'=>1,'msg'=>'Something went wrong!!']);
        }
    }


    public function Register(Request $request)
    {
        try{
            $user = new User();
            $user->first_name = $request->firstname;
            $user->last_name = $request->lastname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->status = 1;
            $user->role_id = 5;
            $user->save();
            $admin="sakpalpurva1@gmail.com";
            $data = ['fname' => $request->firstname,'lname' => $request->lastname,'email' => $request->email,'password' => $request->password];
                $user['to'] = $request->email;

                Mail::send('Mail.UserRegisteredMail',$data,function($message) use ($user){
                $message->to($user['to']);
                $message->subject('Registration Confirmed !');
                });

                $settings=Setting::first();
                if($settings->register == 1){
                    Mail::send('Mail.AdminUserRegisteredMail',$data,function($message) use ($admin){
                        $message->to($admin);
                        $message->subject('New User Registered !');
                    });
                }
            return response()->json(['error' => 0,'msg'=>'User registered successfully']);
        }
        catch(\Illuminate\Database\QueryException $ex){
            if($ex->errorInfo[1]==1062){
                return response()->json(['error'=>1,'msg'=>'Email alredy exists!!']);
            }
            else{
                return response()->json(['error'=>1,'msg'=>'Something went wrong!']);
            }
        }
    }

    //Contact Us API
    public function ContactUs(Request $request)
    {
        try {
            $contact = new ContactUs();
            $contact->name = $request->name;
            $contact->emai = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->status= 0;
            $contact->save();
            return response()->json(['error' => 0]);
        }catch(\Exception $ex){
            return response()->json(['err'=>1,'msg'=>'Something went wrong']);
        }
    }

    //Banner API
    public function Banners()
    {
        $banners = Banner::all();
        return response()->json(['banners' => $banners]);
    }

    //Categories API
    public function Categories()
    {
        $categories = Category::with('subcategory')->get();
        return response()->json(['categories' => $categories]);
    }

    //Products API
    public function Products()
    {
        $products = Product::with('images', 'assoc')->get();
        return response()->json(['products' => $products]);
    }
    public function GetProduct($id)
    {
        $product = Product::whereId($id)->with('images', 'assoc')->first();
        return response()->json(['product' => $product]);
    }
    public function GetSubCategory($id)
    {
        $products = Product::where('sub_category_id', $id)->with('images', 'assoc')->get();
        return response()->json(['products' => $products]);
    }

    //Change Password
    public function ChangePassword(Request $request)
    {
       try {
            $user = User::whereId($request->id)->first();
            if (Hash::check($request->oldpass, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->newpass)
                ]);
                return response()->json(['success' => "Password updated!!"]);
            } else {
                return response()->json(['err' => "Old password is wrong"]);
            }
        }catch(\Exception $ex)
        {
            return response()->json(['err'=>1,'msg'=>'Something went wrong!']);
        }
    }

    //User Information
    public function UserInfo()
    {
        $profile = auth('api')->user();
        return response()->json(['user' => $profile]);
    }

    //Edit User
    public function EditUser(Request $req)
    {
        if (User::whereId($req->userid)->update([
            'first_name' => $req->firstname,
            'last_name' => $req->lastname,
            'email' => $req->email
        ])) {
            return response()->json(['success' => 'User updated successfully!', 'err' => 0]);
        } else {
            return response()->json(['err' => 'Error while registering']);
        }
    }

    //To show coupons
    public function Coupons()
    {
        $coupons = Coupon::all();
        return response()->json(['coupons' => $coupons]);
    }

    //To apply coupon
    public function ApplyCoupon(Request $req)
    {
        try{
            $coupon = Coupon::where('code', $req->code)->where('cart_value', '<=', $req->carttotal)->first();
        if (!$coupon) {
            return response()->json(['err' => "Invalid coupon"]);
        } else {
            $couponvalue = $coupon->value;
            $couponid = $coupon->id;
            return response()->json(['success' => "Coupon applied sucessfully", 'cvalue' => $couponvalue, 'couponid' => $couponid, 'err' => 0]);
        }
        }catch(\Exception $ex){
            return response()->json(['err'=>1,'msg'=>'Something went wrong']);
        }
    }

    //To Add to wishlist
    public function AddToWishlist(Request $req)
    {
        try{
            $wishlist = new Wishlist();
            $wishlist->user_id = $req->user;
            $wishlist->product_id = $req->pid;
            $wishlist->product_name = $req->pname;
            $wishlist->product_price = $req->price;
            $wishlist->product_image = $req->image;
            $wishlist->product_description = $req->description;
            $wishlist->save();
            return response()->json(['err' => 0, 'msg' => 'Added to wishlist!!!']);

        }catch(\Exception $ex)
        {
            return response()->json(['err' => 1, 'msg' => 'Something went wrong!']);
        }

    }

    //To show user's wishlist
    public function WishlistProduct($id)
    {
        $products = Wishlist::where('user_id', $id)->get();
        return response()->json(['products' => $products]);
    }

    //To delete wishlist item
    public function DeleteItem(Request $req)
    {
        try {
            Wishlist::whereId($req->pid)->delete();
            return response()->json(['err' => 0, 'msg' => "Deleted sucessfully"]);
        }
        catch(\Exception $ex)
        {
            return response()->json(['err' => 1, 'msg' => "Something went wrong!"]);
        }
    }

    //PlaceOrder
    public function PlaceOrder(Request $req)
    {
        DB::beginTransaction();
        try {
            $email = $req->email;
            $firstname = $req->firstname;
            $middlename = $req->middlename;
            $lastname = $req->lastname;
            $address1 = $req->address1;
            $address2 = $req->address2;
            $pcode = $req->pcode;
            $mobile = $req->mobile;
            $user_id = $req->user;
            // $coupon_id = $req->coupon_id;
            $cart_sub_total = $req->cart_sub_total;
            $shipping_cost = $req->shipping_cost;
            $total = $req->total;
            $status=$req->status;
            $carts = $req->cart;

            $user = User::whereId($user_id)->first();
            $useradd = new UserAddress();
            $useradd->user_id = $user->id;
            $useradd->email = $email;
            $useradd->first_name = $firstname;
            $useradd->middle_name = $middlename;
            $useradd->last_name = $lastname;
            $useradd->address1 = $address1;
            $useradd->address2 = $address2;
            $useradd->postal_code = $pcode;
            $useradd->mobile_no = $mobile;
            $user->useraddress()->save($useradd);

            $useraddressid = UserAddress::latest()->first();

            $orderdetail = new OrderDetails();
            $orderdetail->user_id = $user->id;
            $orderdetail->cart_sub_total = $cart_sub_total;
            $orderdetail->shipping_cost = $shipping_cost;
            $orderdetail->total = $total;
            $orderdetail->status=$status;
            if ($req->coupon_id) {
                $coupon = new CouponsUsed();
                $coupon->user_address_id = $useraddressid->id;
                $coupon->coupon_id = $req->coupon_id;
                $useraddressid->couponused()->save($coupon);

                $cused = CouponsUsed::latest()->first();
                $orderdetail->coupon_id = $cused->coupon_id;
            }
            $orderdetail->user_address_id = $useraddressid->id;

            if ($useraddressid->orderdetail()->save($orderdetail)) {
                $orderid = OrderDetails::latest()->first();
                foreach ($carts as $cart) {
                    $userorder = new UserOrder();
                    $userorder->user_address_id = $useraddressid->id;
                    $userorder->order_id = $orderid->id;
                    $userorder->product_id = $cart['pid'];
                    $userorder->product_quantity = $cart['quantity'];
                    $useraddressid->userorder()->save($userorder);
                }
                $data = ['fname' => $req->firstname,'lname' => $req->lastname,'email' => $req->email,'password' => $req->password,'address1'=>$req->address2,'address2'=>$req->address2,'pcode'=>$req->pcode,'mobile'=>$req->mobile,'cart_sub_total'=>$req->cart_sub_total,'shipping_cost'=>$shipping_cost,'total'=>$total];
                $user['to'] = $req->email;

                Mail::send('Mail.OrderConfirmationMail',$data,function($message) use ($user){
                $message->to($user['to']);
                $message->subject('Order Confirmation !');
                });

                $settings=Setting::first();
                $admin="sakpalpurva1@gmail.com";
                if($settings->order == 1){
                    Mail::send('Mail.OrderConfirmationMail',$data,function($message) use ($admin){
                        $message->to($admin);
                        $message->subject('Order confirmed !');
                    });
                }
                DB::commit();
                return response()->json(['success' => "Order Placed Successfully", 'err' => 0]);
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['err' => 1, 'msg' => 'Something went wrong']);
        }
    }

    public function MyOrders($id)
    {
        try {
            $user=UserAddress::where('user_id',$id)->with('orderdetail','userorder')
            ->get();
        //      $user=UserAddress::join('users','users.id','=','user_addresses.user_id')
        // ->join('order_details','order_details.user_address_id','=','user_addresses.id')
        // ->join('user_orders','user_orders.user_address_id','=','user_addresses.id')
        // ->join('products','products.id','=','user_orders.product_id')
        // ->get();
        $products=Product::with('images')->get();
            return response()->json(['order' => $user,'products'=>$products]);
        } catch (\Exception $ex) {
            return response()->json(['err' => 1, 'error' => 'Something went wrong']);
        }
    }

    public function Logout()
    {
        auth()->logout();
        return response()->json(["success" => "User Logout Successfully"]);
    }
    public function BannerImage()
    {
        $banners = CMSHeader::latest()->first();
        return response()->json(['banners' => $banners]);
    }
    public function CmsAddress()
    {
        $add = CMSAddress::latest()->first();
        return response()->json(['add' => $add]);
    }
}
