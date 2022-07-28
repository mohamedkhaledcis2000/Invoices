<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $invoices=Invoices::all();
        return view('invoices.invoices',compact('invoices'));
    }

//    function for getting products with ajax
    public function getProducts($id)
    {
        $products = DB::table('products')->where('section_id','=',$id)->pluck('name','id');
        return json_encode($products);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections =Sections::all();
        return view('invoices.add_invoices',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //        laravel validation
        $validated = $request->validate([
            'invoices_number' => 'required|max:999',
            'invoices_date' => 'required',
            'invoices_done_date' =>'required',
            'product'=>'required',
            'section'=>'required',
            'commission'=>'required|max:999',
            'discount'=>'required|max:999',
            'tax_value'=>'required|max:999',
            'tax_rate'=>'required'
        ],[
            'invoices_number' => 'يرجي ادخال رقم الفاتورة',
            'invoices_date' => 'يرجي ادخال تاريخ الفاتورة',
            'invoices_done_date' =>'يرجي ادخال تاريخ الاستحقاق',
            'product'=>'يرجي ادخال منتج',
            'section'=>'يرجي ادخال قسم',
            'commission'=>'يرجي ادخال العمولة',
            'discount'=>'يرجي ادخال الخصم',
            'tax_value'=>'يرجي ادخال قيمة الضريبة',
            'tax_rate'=>'يرجي ادخال نسبة الضريبة'
        ]);

        invoices::create([
            'invoices_number' => $request->invoices_number,
            'invoices_date' => $request->invoices_date,
            'invoices_done_date' => date("Y-m-d H:i:s",$request->invoices_done_date),
            'product' => $request->product,
            'section_id' => $request->section_id,
            'section' => $request->section,

//            'Amount_collection' => $request->Amount_collection,
            'commission' => $request->commission,
            'discount' => $request->discount,
            'tax_value' => $request->tax_value,
            'tax_rate' => $request->tax_rate,
            'total' => $request->total,
            'Status' => 'Not Paid',
            'status_value' => '2',
            'note' => $request->note,
            'user'=>Auth::user()->name
        ]);

        return redirect('invoices');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(Invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoices $invoices)
    {
        //
    }
}
