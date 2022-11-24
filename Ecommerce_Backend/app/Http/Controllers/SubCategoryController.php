<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
class SubCategoryController extends Controller
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
         $data = SubCategory::orderBy('created_at', 'desc')->paginate(3);
         return view('subcategory.managesubcategory', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $action="Add";
        $action_url=route('subcategory.store');
        $category = Category::all();
        return view('subcategory.createform',compact('category','action','action_url'));
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
            'name' => ['required', 'string', 'max:255','unique:sub_categories'],
            'description' => ['required', 'string'],
            'category_id' => ['required'],
            
        ]);
                $subcategory = new SubCategory();
                $subcategory->name = $request->name;
                $subcategory->description = $request->description;
                $subcategory->category_id = $request->category_id;
                $subcategory->save();
                return redirect()->route('subcategory.index')->with('success', "Subcategory created successfully");
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
        $action_url=route('subcategory.update',$id);
        $data = SubCategory::find($id);
        $category = Category::all();
        return view('subcategory.createform', compact('data','category','action','action_url'));
        
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
        $subcategory = SubCategory::findOrFail($id);
        try {
            $validate = $request->validate([
                'name' => ['required', 'string', 'max:255','unique:sub_categories,name,'.$id],
                'description' => ['required', 'string'],
                'category_id' => ['required'],
            ]);
                    
           
            $subcategory->name = $request->name;
            $subcategory->description = $request->description;
            $subcategory->category_id = $request->category_id;
            $subcategory->save();
                    return redirect()->route('subcategory.index')->with('success', "Subcategory updated successfully");
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
            $data = SubCategory::findOrFail($id);
            if ($data->delete()) {
                return back()->with('success', "SubCategory Deleted Succcessfully");
            } else {
                return back()->with('error', "Error while deleting category");
            }
            // return back()->with('success', "Deleted Successfully");
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->route('error_page')->with('error', $ex->getMessage());
        }
    }
}
