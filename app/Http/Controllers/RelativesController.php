<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Relatives;
use App\Models\Profile;
use App\Models\Relations;
use Yajra\DataTables\DataTables;

class RelativesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createRelatives(Request $request)
    {
        $insert = new Relatives();
        $insert->profile_id = $request->input('profile_id');
        $insert->relation_id = $request->input('relation_id');
        $insert->name = $request->input('relatives_name');
        $insert->email = $request->input('relatives_email');
        $insert->job = $request->input('relatives_job');
        $insert->phone = $request->input('relatives_phone');
        $insert->is_emergency = $request->input('is_emergency');
        $insert->delete_relative = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editRelatives(Request $request)
    {
        $model = Relatives::where('id', $request->input('contRelatives_id'))->first();
        $data = [];
        $data['profile_id'] = $model->profile_id;
        $data['relation_id'] = $model->relation_id;
        $data['relatives_name'] = $model->name;
        $data['relatives_email'] = $model->email;
        $data['relatives_job'] = $model->job;
        $data['relatives_phone'] = $model->phone;
        $data['is_emergency'] = $model->is_emergency;
        return response()->json([
            'success' => 1,
            'data' => $data
        ]);
    }

    public function updateDataRelatives(Request $request)
    {
        $update = Relatives::where('id', $request->input('contRelatives_id'))->first();
        $update->profile_id = $request->input('profile_id');
        $update->relation_id = $request->input('relation_id');
        $update->name = $request->input('relatives_name');
        $update->email = $request->input('relatives_email');
        $update->job = $request->input('relatives_job');
        $update->phone = $request->input('relatives_phone');
        $update->is_emergency = $request->input('is_emergency');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteRel(Request $request)
    {
        $softdelete = Relatives::where('id', $request->input('contRelatives_id'))->first();
        $softdelete->delete_relative = 1;
        $softdelete->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $softdelete->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readRelatives($id)
    {
        $model = Profile::where('id', $id)->get();
        $read = Relations::all();
        return view("relatives.mainRelatives", [
            'title' => 'My Relatives',
            'title_menu' => 'Relatives',
            'profile_id' => $id,
            'id' => $id,
            'model' => $model,
            'read' => $read
        ]);
    }

    public function getRelatives($id)
    {
        $data = Relatives::where('profile_id', $id)
        ->where('delete_relative', 0)
        ->get();
        return DataTables::of($data)
        ->addColumn('name', function ($data) {
            return $data->name;
        })
        ->addColumn('relation_id', function ($data) {
            return $data->changeIdRelatives->name;
        })
        ->addColumn('phone', function ($data) {
            return $data->phone;
        })
        ->addColumn('email', function ($data) {
            return $data->email;
        })
        ->addColumn('job', function ($data) {
            return $data->job;
        })
        ->addColumn('is_emergency', function ($data) {
            return $data->is_emergency;
        })
        ->addColumn('action', function ($data) {
            return
            '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->id.'">
                <i class="fa-regular fa-pen-to-square"></i>
            </button>
            <button class="btn btn-icon btn-danger for-delete" data-id="'.$data->id.'" data-relative='.$data->name.'>
                <i class="fa-regular fa-trash-can"></i>
            </button>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
