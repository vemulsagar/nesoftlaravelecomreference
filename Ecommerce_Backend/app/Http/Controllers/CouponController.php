<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**to access these controller */ 
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data = Coupon::orderBy('created_at', 'desc')->paginate(3);
         return view('coupons.manage', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $action="Add";
        $action_url=route('coupons.store');
        return view('coupons.form',compact('action','action_url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //var_dump('store');die;
        try {
        $validate = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string','unique:coupons'],
            'value' => ['required'],
            
        ]);
                $obj = new Coupon();
                $obj->title = $request->title;
                $obj->code = $request->code;
                $obj->value = $request->value;
                $obj->save();
                return redirect()->route('coupons.index')->with('success', "Coupon created successfully");
       }
       catch(\Illuminate\Database\QueryException $ex){
        return redirect()->route('error_page')->with('error', $ex->errorInfo[2]);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action="Update";
        $action_url=route('coupons.update',$id);
        $data = Coupon::find($id);
        return view('coupons.form', compact('data','action','action_url'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $obj = Coupon::findOrFail($id);
        try {
            $validate = $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'code' => ['required', 'string','unique:coupons,code,'.$id],
                'value' => ['required'],
                
            ]);
                   
                    $obj->title = $request->title;
                    $obj->code = $request->code;
                    $obj->value = $request->value;
                    $obj->save();
                    return redirect()->route('coupons.index')->with('success', "Coupon updated successfully");
           }
           catch(\Illuminate\Database\QueryException $ex){
            return redirect()->route('error_page')->with('error', $ex->errorInfo[2]);
           }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Coupon::findOrFail($id);
            if ($data->delete()) {
                return back()->with('success', "Coupon Deleted Succcessfully");
            } else {
                return back()->with('error', "Error while deleting category");
            }
            // return back()->with('success', "Deleted Successfully");
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->route('error_page')->with('error', $ex->getMessage());
        }
    }
}
