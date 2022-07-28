<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=Sections::all();
        $products=products::all();
        return view('products.products',compact('products','sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
//        dd($request);
        // request sent from the form to add new section
        //the request has name and description

//        laravel validation
        $validated = $request->validate([
            'name' => 'required|unique:sections|max:255',
            'description' => 'required|max:255',
            'section_id' => 'required|required:sections'
        ],[
        'name.required' => 'يرجي ادخال اسم القسم',
        'name.unique' => 'هذا القسم موجود بالفعل',
        'description.required' => 'يرجي ادخال الوصف',
        'section_id.required'=> 'يرجي اختيار القسم'

        ]);

        products::create([
            'name'=>$request->name,
            'section_id'=>$request->section_id,
            'description'=>$request->description,
        ]);

        return redirect('/products');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(products $products , $id)
    {
        $product = products::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index');
    }
}
