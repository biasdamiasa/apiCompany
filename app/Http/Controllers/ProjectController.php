<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function show()
    {
        $project = Project::all();

        return Response()->json($project);
    }

    public function detail($id)
    {
        if(Project::where('id', $id)->exists())
        {
            $project = Project::where('id', $id)->get();

            return Response()->json($project);
        }
        else
        {
            return Response()->json(['message' => 'Data not found']);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'projectName' => 'required',   
                'startDate' => 'required',   
                'endDate' => 'required',                   
            ]
        );

        if($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $save = Project::create([
            'projectName' => $request->projectName,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate
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
        if(Project::where('id', $id)->exists())
        {
            $validator = Validator::make($request->all(),
            [
                'projectName' => 'required',   
                'startDate' => 'required',   
                'endDate' => 'required',                   
            ]
            );

            if($validator->fails()) {
                return Response()->json($validator->errors());
            }

            $update = Project::where('id', $id)->update([
                'projectName' => $request->projectName,
                'startDate' => $request->startDate,
                'endDate' => $request->endDate
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
        if(Project::where('id', $id)->exists())
        {
            $delete = Project::where('id', $id)->delete();

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
            Return Response()->json(['message' => 'ID not found']);
        }
    }
}
