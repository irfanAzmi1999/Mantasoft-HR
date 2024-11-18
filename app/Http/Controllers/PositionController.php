<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Position;
use App\Models\Department;
use Yajra\DataTables\DataTables;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createPosition(Request $request)
    {
        $insert = new Position();
        $insert->department_id = $request->input('department_id');
        $insert->name = $request->input('position_name');
        $insert->delete_position = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editPosition(Request $request)
    {
        $model = Position::where('id', $request->input('id_position'))->first();
        $data = [];
        $data['name'] = $model->name;
        $data['department_id'] = $model->department_id;
        return response()->json([
            'success' => 1,
            'data' => $data
        ]);
    }

    public function updatePosition(Request $request)
    {
        $update = Position::where('id', $request->input('id_position'))->first();
        $update->department_id = $request->input('department_id');
        $update->name = $request->input('position_name');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeletePos(Request $request)
    {
        $delPosition = Position::where('id', $request->input('id_position'))->first();
        $delPosition->delete_position = 1;
        $delPosition->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $delPosition->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readPosition()
    {
        $department = Department::all();
        return view('positions.tableposition', [
            'title' => 'Positions',
            'title_menu' => 'Positions',
            'department' => $department
        ]);
    }

    public function getPosition()
    {
        $data = Position::where('delete_position', 0)->get();
        return Datatables::of($data)
        ->addColumn('name', function ($data) {
            return $data->name;
        })
        ->addColumn('department_id', function ($data) {
            return $data->getDepartment->name;
        })
        ->addColumn('action', function ($data) {
            return
            '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->id.'">
                <i class="fa-regular fa-pen-to-square"></i>
            </button>
            <button class="btn btn-icon btn-danger for-delete" data-id="'.$data->id.'">
                <i class="fa-regular fa-trash-can"></i>
            </button>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
