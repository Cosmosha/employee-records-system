<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Employee $empolyee){
        return view('index');
    }

   // ─── Handle Insert Employee Ajax ────────────────────────────────────────────────

    public function  store(Request $request){
        $file = $request->file('avatar');
        $fileName= time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $empData = [
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->$fileName
        ];


        Employee::create($empData);
        return response()->json([
            'status' => 200,
        ]);

    }
}
