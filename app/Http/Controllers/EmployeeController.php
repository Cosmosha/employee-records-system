<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
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
            'role' => $request->post,
            'photo' => $fileName
        ];


        Employee::create($empData);
        return response()->json([
            'status' => 200,
        ]);

    }


    // ─── Handle Fetchall Employee Ajax Request ──────────────────────────────────────

    public function fetchAll(){
        $emps = Employee::all();
        $display = '';

        if ($emps->count() > 0 ) {
            # code...
            $display .= '<table id="example" class="table table-striped table-sm text-center align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';

                foreach ($emps as $key => $emp) {
                    # code...
                    $display .= '<tr>
                        <td>'.$key+(1).'</td>
                        <td> <img src= "storage/images/'.$emp->photo.'" width="50" class="img-img-thumbnail rounded-circle"</td>
                        <td>'.$emp->first_name.' '.$emp->last_name.'</td>
                        <td> '.$emp->email.'</td>
                        <td>'.$emp->role.'</td>
                        <td>'.$emp->phone.'</td>
                        <td>
                            <a href="#" id="'.$emp->id.'" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal">
                            <i class="bi-pencil-square h4"></i></a>

                            <a href="#" id="'.$emp->id.'" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                        <td>
                    </tr>';
                }

                $display .='</tbody></table>';

                echo $display;
        }else {
            # code...
            echo '<h1 class="text-center text-secondary my-5">No Records Found</h1>';
        }
    }

    // ─── Handle Edit Employee Records Ajax Request ──────────────────────────────────

    public function edit(Request $request){
        $id = $request->id;
        $emp = Employee::find($id);
        return response()->json($emp);
    }


    // ─── Handle Update Employee Records Ajax Request ────────────────────────────────

    public function update(Request $request){
        
    }

}
