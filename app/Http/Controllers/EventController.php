<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use DB;
use Twilio\Rest\Client;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $data = Event::get();

        //
        $data = DB::table('events')
            ->join('customers', 'events.id_customer', '=', 'customers.id')
            ->join('products', 'events.id_product', '=', 'products.id')
            ->select(
                'events.id', 
                'events.note', 
                'events.date_event',
                'events.time_event', 
                'customers.document',
                'customers.first_name', 
                'customers.last_name',
                'products.product',
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
        $event = Event::create(
        [   
            'id_customer' => $request->id_customer, 
            'id_product' => $request->id_product,
            'title' => '', 
            'note' => $request->note,
            'date_event' => $request->cita,
            'time_event' => $request->time
        ]);
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function sendwsp($msg)
    {
        $sid    = env('TWILIO_SID'); //"ACda8970a89d2e2e88ad71848a349b5b1c"; 
        $token  = env('TWILIO_TOKEN'); //"[AuthToken]"; 
        // $number = env('TWILIO_FROM');

        $twilio = new Client($sid, $token);

        $message = $twilio->messages 
                        ->create("whatsapp:+51990051584", // to 
                            array(        
                                'from' => "whatsapp:+14155238886", // From a valid Twilio number
                                "body" => $msg 
                            )
                        );
        
        print($message->sid);
    }
}
