<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    public function show()
    {
        $department = Department::all();

        return Response()->json($department);
    }

    public function detail($id)
    {
        if(Department::where('id', $id)->exists())
        {
            $department = Department::where('id', $id)->get();

            return Response()->json($department);
        }
        else
        {
            return Response()->json(['message' => 'ID not found']);
        }
    }
}
