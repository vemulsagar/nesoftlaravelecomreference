<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
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
         $users = User::orderBy('created_at', 'desc')->paginate(3);
         return view('users.manageusers', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $action="Add";
        $action_url=route('user.store');
        $roles = Roles::all();
        return view('users.createform',compact('roles','action','action_url'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'same:confirm_password'],
            'confirm_password' => ['required'],
            'role' => ['required'],
        ]);
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->role_id = $request->role;
                $user->save();
                return redirect()->route('user.index')->with('success', "User created successfully");
       }
       catch(\Illuminate\Database\QueryException $ex){
        return redirect()->route('error_page')->with('error', $ex->getMessage());
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
        $action_url=route('user.update',$id);
        $user = User::find($id);
        $roles = Roles::all();
        return view('users.createform', compact('user','roles','action','action_url'));
        
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
        $user = User::findOrFail($id);
        try {
            $validate = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
                'role' => ['required'],
            ]);
                    
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->role_id = $request->role;
                    $user->save();
                    return redirect()->route('user.index')->with('success', "User updated successfully");
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
            $user = User::findOrFail($id);
            if ($user->delete()) {
                return back()->with('success', "User Deleted Succcessfully");
            } else {
                return back()->with('error', "Error while deleting category");
            }
            // return back()->with('success', "Deleted Successfully");
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->route('error_page')->with('error', $ex->getMessage());
        }
    }
}
