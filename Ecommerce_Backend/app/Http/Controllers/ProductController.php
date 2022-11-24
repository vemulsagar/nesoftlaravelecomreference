<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\ProductImages;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $data = Product::orderBy('created_at', 'desc')->paginate(5);
        return view('product.manage', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action="Add";
        $action_url=route('product.store');
        $category = Category::all();
        $brand = Brand::all();
        return view('product.form',compact('brand','category','action','action_url'));
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
             'name' => ['required', 'string', 'max:255','unique:products'], 
             'product_images.*'=>['required', 'mimes:jpg,jpeg,png'],
             'category_id'=>['required'], 
             'brand_id'=>['required'],  
             'model'=>['required'],  
             'desc'=>['required'],  
             'short_desc'=>['required'],  
             'keywords'=>['required'],  
             'uses'=>['required'],  
             'warranty'=>['required'],  
             'technical_specifications'=>['required'],  
             
        ]);

                $obj = new Product();
                $obj->name = $request->name;
                $obj->category_id = $request->category_id;
                $obj->brand_id = $request->brand_id;
                $obj->model = $request->model;
                $obj->desc = $request->desc;
                $obj->short_desc = $request->short_desc;
                $obj->keywords = $request->keywords;
                $obj->technical_specifications = $request->technical_specifications;
                $obj->warranty = $request->warranty;
                $obj->uses = $request->uses;
                $obj->save();
                $product_id = $obj->id;

                $allowedfileExtension=['jpg','png','jpeg'];
                $files = $request->product_images;
                foreach($files as $file){
                
                    $extension = $file->extension();
                    $check=in_array($extension,$allowedfileExtension);
                    if($check)
                        {
                       
                        $image_name=rand(0,10000).'_'.time().'.'.$extension;
                        $file->storeAs('public/media/',$image_name);
                    
                        ProductImages::create([
                        'product_id' => $product_id,
                        'image' => $image_name
                        ]);
                         
                    }
                }
                
               
                return redirect()->route('product.index')->with('success', "Product created successfully");
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
        //
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
        $action_url=route('product.update',$id);
        $data=Product::findorFail($id);
       
        $category = Category::all();
        $brand = Brand::all();
        return view('product.form',compact('data','brand','category','action','action_url'));
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
        $obj = Product::findOrFail($id);
        //udump($request->all());die;
      try {
        $validate = $request->validate([
             'name' => ['required', 'string', 'max:255','unique:products,name,'.$id], 
             'product_images.*'=>['mimes:jpg,jpeg,png'],
             'category_id'=>['required'], 
             'brand_id'=>['required'],  
             'model'=>['required'],  
             'desc'=>['required'],  
             'short_desc'=>['required'],  
             'keywords'=>['required'],  
             'uses'=>['required'],  
             'warranty'=>['required'],  
             'technical_specifications'=>['required'],  
             
        ]);

                
                $obj->name = $request->name;
                $obj->category_id = $request->category_id;
                $obj->brand_id = $request->brand_id;
                $obj->model = $request->model;
                $obj->desc = $request->desc;
                $obj->short_desc = $request->short_desc;
                $obj->keywords = $request->keywords;
                $obj->technical_specifications = $request->technical_specifications;
                $obj->warranty = $request->warranty;
                $obj->uses = $request->uses;
                $obj->save();
                $product_id = $obj->id;

                $allowedfileExtension=['jpg','png','jpeg'];
                $files = $request->product_images;

                if(isset($files) && !empty($files))
                { 
                    foreach($obj->productimages as $eachimg){
                        if(Storage::exists('/public/media/'.$eachimg->image)){
                            Storage::delete('/public/media/'.$eachimg->image);
                        }
                        ProductImages::find($product_id)->forceDelete();
                    }

                    foreach($files as $file){
                
                        $extension = $file->extension();
                        $check=in_array($extension,$allowedfileExtension);
                        if($check)
                            {
                           
                            $image_name=rand(0,10000).'_'.time().'.'.$extension;
                            $file->storeAs('public/media/',$image_name);
                        
                            ProductImages::create([
                            'product_id' => $product_id,
                            'image' => $image_name
                            ]);
                             
                        }
                    }
                }
                
                
               
                return redirect()->route('product.index')->with('success', "Product updated successfully");
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
            $data = Product::findOrFail($id);
            if ($data->delete()) {
                return back()->with('success', "Product Deleted Succcessfully");
            } else {
                return back()->with('error', "Error while deleting category");
            }
            // return back()->with('success', "Deleted Successfully");
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->route('error_page')->with('error', $ex->getMessage());
        }
    }
}
