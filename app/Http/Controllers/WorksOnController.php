<?php

namespace App\Http\Controllers;

use App\WorksOn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorksOnController extends Controller
{
    public function show()
    {
        $workson = WorksOn::leftjoin('employees', 'works_ons.id_emp', 'employees.id')
                            ->leftjoin('projects', 'works_ons.id_proj', 'projects.id')
                            ->select('works_ons.id', 'employees.first_name', 'projects.projectName')
                            ->get();

        return Response()->json($workson);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'id_emp' => 'required',
            'id_proj' => 'required'
        ]);

        if($validator->fails())
        {
            return Response()->json($validator->errors());
        }

        $save = WorksOn::create([
            'id_emp' => $request->id_emp,
            'id_proj' => $request->id_proj
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

    public function findEmpProj($id)
    {
        $empProj = WorksOn::leftjoin('projects', 'works_ons.id_proj', 'projects.id')
                                 ->where('works_ons.id_emp', $id)
                                 ->select('projects.projectName', 'projects.startDate', 'projects.endDate')
                                 ->get();

        return Response()->json($empProj);
    }

    public function findProjEmp($id)
    {
        $projEmp = WorksOn::leftjoin('employees', 'works_ons.id_emp', 'employees.id')
                                 ->where('works_ons.id_proj', $id)
                                 ->select('employees.first_name')
                                 ->get();

        return Response()->json($projEmp);
    }

    public function update($id, Request $request)
    {
        if(WorksOn::where('id', $id)->exists())
        {
            $validator = Validator::make($request->all(), 
                [
                    'id_emp' => 'required',
                    'id_proj' => 'required'
                ]
            );

            if($validator->fails())
            {
                return Response()->json($validator->errors());
            }

            $update = WorksOn::where('id', $id)->update(
                [
                    'id_emp' => $request->id_emp,
                    'id_proj' => $request->id_proj
                ]
            );

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
            return Response()->json(['message' => 'ID not found']);
        }
    }

    public function destroy($id)
    {
        if(WorksOn::where('id', $id)->exists())
        {
            $delete = WorksOn::where('id', $id)->delete();

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
