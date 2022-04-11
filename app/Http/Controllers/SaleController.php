<?php

namespace App\Http\Controllers;

// use Auth;
// use App\Models\User;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Event;
use Illuminate\Http\Request;
use DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('sales')
            ->join('sale_details', 'sales.id', '=', 'sale_details.id_sale')
            ->join('customers', 'sales.id_customer', '=', 'customers.id')
            ->join('products', 'sale_details.id_product', '=', 'products.id')
            ->select(
                'sales.id', 
                'sales.created_at', 
                'sales.note',
                'sales.total', 
                'customers.document',
                'customers.first_name', 
                'customers.last_name',
                // 'customers.note', 
                'products.product',
                'products.type', 
                'sale_details.unit_price',
                'sale_details.quantity', 
                'products.percent_employee'
                )
            ->get();

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
        //
        $sale_created = Sale::create(
        [   
            'id_customer' => $request->id_customer, 
            'id_employee' => $request->id_employee,
            'note' => $request->note,
            'total' => $request->total
        ]);

        $array_detail = explode('|', $request->detail);
        foreach ($array_detail as $values)
        {
            $items = explode('_', $values);
            SaleDetail::create(
            [
                'id_sale' => $sale_created->id,
                'id_product' => $items[0],
                'quantity' => $items[1],
                'unit_price' => $items[2],
            ]);

            $product = Product::find($items[0]);
            $product->quantity = $product->quantity - intval($items[1]);
            $product->save();

        }

        $customer = Customer::updateOrCreate(
            [   'id' => $request->id_customer ],
            [   
                'note' => $request->note,
            ]);

        if($request->cita != '') {

            $event = Event::create(
            [   
                'id_customer' => $request->id_customer, 
                'id_product' => $request->id_product,
                'title' => '', 
                'note' => $request->note,
                'date_event' => $request->cita,
                'time_event' => $request->time,
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function employee(Request $request)
    {
        $data = Employee::where('status', 1)->where('id_user', $request->user()->id)->get();
        if ( count($data) == 0 ) {
            $data = Employee::where('status', 1)->get();
        }
        return response()->json(['success' => true, 'data' => $data], 201);
    }
}
