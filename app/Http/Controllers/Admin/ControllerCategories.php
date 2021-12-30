<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\item;

class ControllerCategories extends Controller
{    private  $fileView="admin.Gallery";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

       
        $Category= new Category;
        $dataCategory = $Category->all();

        $item = new item;
        $dataItme =$item->all();
        

         return view("admin.Gallery.ProductSpecification",compact(['dataCategory','dataItme']));
        
    }

    /**
     * Show the form for creating a new resource.   
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //create Category
        
        $Category = new Category;
        $Category->NameCategory = $request->input('NameCategory');
        $Category->save();
        $item = new item;
        
        $item->Nameitem = $request->input('Nameitem');
        $item->categories_id = $Category->id; 
        $item->save();
        
        dd($item);
        
      
    }
    
    
    
    
    public function showAdd(){
        
        
       return view('admin.Gallery.AddCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        $item =item::where('categories_id','=',$id)->delete();
        $Category =Category::find($id)->delete();
        return redirect("shoop2");
    }
}
