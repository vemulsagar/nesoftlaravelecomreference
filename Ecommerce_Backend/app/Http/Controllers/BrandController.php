<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Storage;
class BrandController extends Controller
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
       $data = Brand::orderBy('created_at', 'desc')->paginate(3);
       return view('brands.manage', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {   
      $action="Add";
      $action_url=route('brands.store');
      return view('brands.form',compact('action','action_url'));
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
          'name' => ['required', 'string', 'max:255','unique:brands'], 
          'image'=>['required', 'mimes:jpg,jpeg,png']  
      ]);
              $obj = new Brand();
              $obj->name = $request->name;
              $file=$request->image;
              $file_ext=$file->extension();
              $filename=rand(0,10000).'_'.time().'.'.$file_ext;
              $file->storeAs('public/media/',$filename);
              $obj->image=$filename;
              $obj->save();
              return redirect()->route('brands.index')->with('success', "Brand created successfully");
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
      $action_url=route('brands.update',$id);
      $data = Brand::find($id);
      return view('brands.form', compact('data','action','action_url'));
      
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
      $obj = Brand::findOrFail($id);
      try {
          $validate = $request->validate([
              'name' => ['required', 'string','max:255','unique:brands,name,'.$id],
              'image'=>['mimes:jpg,jpeg,png']
              
              
          ]);
        
          if(!empty($request->image)){
                
            if(Storage::exists('/public/media/'.$obj->image)){
                    Storage::delete('/public/media/'.$obj->image);
                }
            

                $file=$request->image;
                $file_ext=$file->extension();
                $filename=rand(0,10000).'_'.time().'.'.$file_ext;
                $file->storeAs('public/media/',$filename);
                $obj->image=$filename;
            
         }

                  $obj->name = $request->name;
                  
                  $obj->save();
                  return redirect()->route('brands.index')->with('success', "Brand updated successfully");
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
          $data = Brand::findOrFail($id);
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
