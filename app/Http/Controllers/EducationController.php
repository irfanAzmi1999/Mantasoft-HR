<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Education;
use App\Models\Profile;
use Yajra\DataTables\DataTables;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createEducation(Request $request)
    {
        $insert = new Education();
        $insert->profile_id = $request->input('profile_id');
        $insert->school_name = $request->input('school_name');
        $insert->year_from = $request->input('year_from');
        $insert->year_to = $request->input('year_to');
        $insert->achievement = $request->input('achievement');
        $insert->result = $request->input('result');
        $insert->delete_education = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editEducation(Request $request)
    {
        $model = Education::where('id', $request->input('constEducation_id'))->first();
        $data = [];
        $data['profile_id'] = $model->profile_id;
        $data['school_name'] = $model->school_name;
        $data['year_from'] = $model->year_from;
        $data['year_to'] = $model->year_to;
        $data['achievement'] = $model->achievement;
        $data['result'] = $model->result;
        return response()->json([
            'success' => 1,
            'data' => $data
        ]);
    }

    public function updateEducation(Request $request)
    {
        $update = Education::where('id', $request->input('constEducation_id'))->first();
        $update->profile_id = $request->input('profile_id');
        $update->school_name = $request->input('school_name');
        $update->year_from = $request->input('year_from');
        $update->year_to = $request->input('year_to');
        $update->achievement = $request->input('achievement');
        $update->result = $request->input('result');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteEducation(Request $request)
    {
        $softdel = Education::where('id', $request->input('constEducation_id'))->first();
        $softdel->delete_education = 1;
        $softdel->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $softdel->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readEducation($id)
    {
        $model = Profile::where('id', $id)->get();
        $currentYear = date('Y');
        return view('educations.tableeducation', [
            'title' => 'My Educations',
            'title_menu' => 'Education',
            'profile_id' => $id,
            'id' => $id,
            'model' => $model,
            'currentYear' => $currentYear
        ]);
    }

    public function getEducations($id)
    {
        $data = Education::where('profile_id', $id)
        ->where('delete_education', 0)
        ->where('profile_id', $id)
        ->get();
        return DataTables::of($data)
        ->addColumn('school_name', function ($data) {
            return $data->school_name;
        })
        ->addColumn('year', function ($data) {
            return $data->year_from . ' – ' . $data->year_to;
        })
        ->addColumn('achievement', function ($data) {
            return $data->achievement;
        })
        ->addColumn('result', function ($data) {
            return $data->result;
        })
        ->addColumn('action', function ($data) {
            return
            '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->id.'">
                <i class="fa-regular fa-pen-to-square"></i>
            </button>
            <button class="btn btn-icon btn-danger for-delete" data-id="'.$data->id .'" data-education='.$data->school_name.'>
                <i class="fa-regular fa-trash-can"></i>
            </button>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
