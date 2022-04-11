<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function sale()
    {
        return view('sale.sale');
    }
    
    public function reportdetail()
    {
        return view('sale.reportdetail');
    }

    
    public function customer()
    {
        return view('masters.customer');
    }
    public function employee()
    {
        return view('masters.employee');
    }
    public function product()
    {
        return view('masters.product');
    }
    public function service()
    {
        return view('masters.service');
    }
    public function stock()
    {
        return view('masters.stock');
    }
    public function reportgeneral()
    {
        return view('sale.reportgeneral');
    }
    public function events()
    {
        return view('events.index');
    }



}
