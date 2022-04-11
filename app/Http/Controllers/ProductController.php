<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = [];
        if(is_null($request->type)){
            $data = Product::where('status', '=', 1, 'and')->get();
        } else {
            $data = Product::where('status', '=', 1, 'and')->where('type', '=', $request->type)->get();
        }
        
        return response()->json(['success' => true, 'data' => $data], 201);
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
    public function store(Request $request)
    {

        // dd($request);
        //
        $product = Product::updateOrCreate(
            [   'id' => $request->id ],
            [   'code' => $request->code, 
                'product' => $request->product,
                'description' => $request->description,
                'type' => $request->type,
                'unit_price' => $request->unit_price,
                'percent_employee' => $request->percent_employee,
                'quantity' => $request->quantity
            ]);
        
        $leter = $request->type == 1 ? 'S' : 'P';
        $product->code = $leter. str_pad($product->id,4,"0", STR_PAD_LEFT);
        $product->save();
        // dd($product);
    
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $product = Product::updateOrCreate(
        [   'id' => $request->id ],
        [   $request->label => $request->value,
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
