<?php

namespace App\Http\Controllers;

use App\Models\Colors;
use Illuminate\Http\Request;

class ColorsController extends Controller
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
       $data = Colors::orderBy('created_at', 'desc')->paginate(3);
       return view('colors.manage', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {   
      $action="Add";
      $action_url=route('colors.store');
      return view('colors.form',compact('action','action_url'));
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
          'name' => ['required', 'string', 'max:255','unique:colors'],   
      ]);
              $obj = new Colors();
              $obj->name = $request->name;
               $obj->save();
              return redirect()->route('colors.index')->with('success', "Color created successfully");
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
      $action_url=route('colors.update',$id);
      $data = Colors::find($id);
      return view('colors.form', compact('data','action','action_url'));
      
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
      $obj = Colors::findOrFail($id);
      try {
          $validate = $request->validate([
              'name' => ['required', 'string','max:255','unique:colors,name,'.$id],
              
              
          ]);
                 
                  $obj->name = $request->name;
                  
                  $obj->save();
                  return redirect()->route('colors.index')->with('success', "Color updated successfully");
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
          $data = Colors::findOrFail($id);
          if ($data->delete()) {
              return back()->with('success', "Color Deleted Succcessfully");
          } else {
              return back()->with('error', "Error while deleting category");
          }
          // return back()->with('success', "Deleted Successfully");
      } catch (\Illuminate\Database\QueryException $ex) {
          return redirect()->route('error_page')->with('error', $ex->getMessage());
      }
  }
}
