<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductSpecificatio;
class ProductSpecificationCont extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        
        return view("admin.components.ProductSpecification");
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function create(Request $req)
    {
        //Location
        
        $this->validate($req,[
                'Location' => 'required|max:255',
                'OfferType' => 'required|max:255',
                'district' => 'required|max:255',
                'RE_Type' => 'required|max:255',
                'furniture' => 'required|max:255',
        ]);
        $prodact =new ProductSpecificatio;
        $prodact->Location=$req->input("Location");
        $prodact->OfferType=$req->input("OfferType");
        $prodact->district=$req->input("district");
        $prodact->RE_Type=$req->input("RE_Type");
        $prodact->furniture=$req->input("furniture");
        $prodact->save();
       return redirect("shoop2");
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
    }
}
