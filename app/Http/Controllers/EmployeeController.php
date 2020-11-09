<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function show()
    {
        $employee = Employee::leftjoin('departments' , 'employees.id_dep', 'departments.id')
                              ->select('employees.id', 
                              'employees.first_name', 
                              'employees.last_name', 
                              'employees.email',
                              'employees.phone',
                              'employees.city',
                              'departments.dep_name',)
                              ->get();
        return Response()->json($employee);
    }

    public function detail($id)
    {
        if(Employee::where('id', $id)->exists())
        {
            $employee = Employee::leftjoin('departments', 'employees.id_dep', 'departments.id')
                                   ->where('employees.id', '=', $id)  
                                   ->select('employees.id', 
                                            'employees.first_name', 
                                            'employees.last_name', 
                                            'employees.email',
                                            'employees.phone',
                                            'employees.city',
                                            'departments.dep_name',)
                                   ->get();

            return Response()->json($employee);
        }
        else
        {
            return Response()->json(['ID' => 'Data not found']);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'first_name' => 'required',   
                'last_name' => 'required',   
                'email' => 'required',   
                'phone' => 'required',   
                'city' => 'required',   
                'id_dep' => 'required',   
            ]
        );

        if($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $save = Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,   
            'phone' => $request->phone,   
            'city' => $request->city,   
            'id_dep' => $request->id_dep,
        ]);

        if($save) 
        {
            return Response()->json(['message' => 'Successfully saved data']);
        }
        else
        {
            return Response()->json(['message' => 'Failed to save data']);
        }
    }

    public function update($id, Request $request)
    {
        if(Employee::where('id', $id)->exists())
        {
            $validator = Validator::make($request->all(),
            [
                'first_name' => 'required',   
                'last_name' => 'required',   
                'email' => 'required',   
                'phone' => 'required',   
                'city' => 'required',   
                'id_dep' => 'required',   
            ]
            );  

            if($validator->fails()) {
                return Response()->json($validator->errors());
            }

            $update = Employee::where('id', $id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,   
                'phone' => $request->phone,   
                'city' => $request->city,   
                'id_dep' => $request->id_dep,
            ]);

            if($update) 
            {
                return Response()->json(['message' => 'Successfully updated data']);
            }
            else
            {
                return Response()->json(['message' => 'Failed to update data']);
            }
        }
        else
        {
            Return Response()->json(['message' => 'ID not found']);
        }
    }

    public function destroy($id)
    {        
        if(Employee::where('id', $id)->exists())
        {
            $delete = Employee::where('id', $id)->delete();

            if($delete) 
            {
                return Response()->json(['message' => 'Successfully deleted data']);
            }
            else
            {
                return Response()->json(['message' => 'Failed to delete data']);
            }
        }
        else 
        {
            return Response()->json(['message' => 'ID not found']);
        }
    }
}
