<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ProfilePosition;
use App\Models\Department;
use App\Models\Profile;
use Yajra\DataTables\DataTables;

class ProfilePositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createProfilePosition(Request $request)
    {
        $insert = new ProfilePosition();
        $insert->profile_id = $request->input('profile_id');
        $insert->position_id = $request->input('position_id');
        $insert->delete_profileposition = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editProfilePosition(Request $request)
    {
        $model = ProfilePosition::where('id', $request->input('id_profileposition'))->first();
        $data = [];
        $data['profile_id'] = $model->profile_id;
        $data['position_id'] = $model->position_id;
        return response()->json([
            'success' => 1,
            'data' => $data
        ]);
    }

    public function updateProfilePosition(Request $request)
    {
        $update = ProfilePosition::where('id', $request->input('id_profileposition'))->first();
        $update->profile_id = $request->input('profile_id');
        $update->position_id = $request->input('position_id');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteProPos(Request $request)
    {
        $softdelete = ProfilePosition::where('id', $request->input('id_profileposition'))->first();
        $softdelete->delete_profileposition = 1;
        $softdelete->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $softdelete->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readProfilePosition($id)
    {
        $model = Profile::where('id', $id)->get();
        $byDepartment = Department::with('getPosition')->get();
        return view('profilepositions.tableprofileposition', [
            'title' => 'My Positions',
            'title_menu' => 'positions',
            'profile_id' => $id,
            'id' => $id,
            'model' => $model,
            'byDepartment' => $byDepartment
        ]);
    }

    public function getProfilePositions($id)
    {
        $data = ProfilePosition::where('profile_id', $id)
        ->where('delete_profileposition', 0)
        ->get();
        return DataTables::of($data)
        ->addColumn('position_id', function ($data) {
            return $data->getPosition->name;
        })
        ->addColumn('department_id', function ($data) {
            return $data->getPosition->getDepartment->name;
        })
        ->addColumn('action', function ($data) {
            return
            '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->id.'">
                <i class="fa-regular fa-pen-to-square"></i>
            </button>
            <button class="btn btn-icon btn-danger for-delete" data-id="'.$data->id.'" data-position='.$data->getPosition->name.'>
                <i class="fa-regular fa-trash-can"></i>
            </button>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
