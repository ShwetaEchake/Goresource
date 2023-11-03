<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DB;
date_default_timezone_set("Asia/Calcutta");

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categoryvalue']=Category::where('parent_category_id',0)->get();
        $data['categorie']=Category::paginate(5);

        return view('category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $categories= new Category();
       $categories->category_name=$request->category_name;
       $categories->parent_category_id=$request->parent_category_id;
       $categories->status=$request->status;
       $categories->created_by=auth()->user()->id;
       $categories->created_date=strtotime(date('Y-m-d')); 

         if($request->hasfile('category_photo')){
            $file=$request->file('category_photo');
            $extension=$file->getClientOriginalExtension();
            $filename=time() .'.' .$extension;
            $file->move('uploads/itemPic',$filename);
            $categories->category_photo=$filename;
        }
       $categories->save(); 

        return redirect()->route('category.index')->with('success','Category Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $category= Category::find($id);
         $data['categorie']=Category::paginate(5);
        $data['categoryvalue']=Category::where('parent_category_id',0)->get();      
        return view('category.index',compact('category'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $category = Category::find($id);

        $category->category_name=$request->category_name;
       $category->parent_category_id=$request->parent_category_id;
       $category->status=$request->status;
       $category->created_by=auth()->user()->id;
       $category->updated_date=strtotime(date('Y-m-d')); 

            if($request->hasfile('category_photo')){
            $file=$request->file('category_photo');
            $extension=$file->getClientOriginalExtension(); //getting img 
            $filename=time() .'.' .$extension;
            $file->move('uploads/itemPic',$filename);
            $category->category_photo=$filename;
          }

       $category->save();
       return redirect()->route('category.index')->with('success','Category Updated Successfully');
 
    }

    /**
     * Remove the specified resource from storage.
     *

     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = DB::table('categories')->where('category_id',$id)->delete();
        return redirect()->route('category.index')
                        ->with('success','Category Deleted Successfully');
    }
}
