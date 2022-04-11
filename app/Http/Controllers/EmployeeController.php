<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        //
        $data = Employee::where('status', 1)->get();
        return response()->json(['success' => true, 'data' => $data], 201);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //
        Employee::updateOrCreate(
        [   'id' => $request->id ],
        [   'document' => $request->document, 
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'gender' => $request->gender,
            'id_user' => $user->id
        ]);

        return response()->json(['success' => true]);
    }

    //
    public function update(Request $request, Employee $customer)
    {
        //
        $customer = Employee::updateOrCreate(
        [   'id' => $request->id ],
        [   $request->label => $request->value,
        ]);

        return response()->json(['success' => true]);
    }
}
