<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
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
         $data = Category::orderBy('created_at', 'desc')->paginate(5);
         return view('category.managecategory', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $action="Add";
        $action_url=route('category.store');
        return view('category.createform',compact('action','action_url'));
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
            'name' => ['required', 'string', 'max:255','unique:categories'],
            'description' => ['required', 'string'],
           ]);
                $category = new Category();
                $category->name = $request->name;
                $category->description = $request->description;
                
                $category->save();
                return redirect()->route('category.index')->with('success', "Category created successfully");
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
        $action_url=route('category.update',$id);
        $data = Category::find($id);
        
        return view('category.createform', compact('data','action','action_url'));
        
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
        $category = Category::findOrFail($id);
        try {
            $validate = $request->validate([
                'name' => ['required', 'string', 'max:255','unique:categories,name,'.$id],
                 'description' => ['required', 'string'],
            ]);
                    
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            return redirect()->route('category.index')->with('success', "Category updated successfully");
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
            $category = Category::findOrFail($id);
            if ($category->delete()) {
                return back()->with('success', "Category Deleted Succcessfully");
            } else {
                return back()->with('error', "Error while deleting category");
            }
            // return back()->with('success', "Deleted Successfully");
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->route('error_page')->with('error', $ex->getMessage());
        }
    }
}
