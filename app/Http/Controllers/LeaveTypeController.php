<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\LeaveType;
use Yajra\DataTables\Datatables;

class LeaveTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createLeaveType(Request $request)
    {
        $insert = new LeaveType();
        $insert->name = $request->input('leavetype_name');
        $insert->limit = $request->input('limit');
        $insert->delete_LeaveType = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editLeaveType(Request $request)
    {
        $model = LeaveType::where('id', $request->input('id_leavetype'))->first();
        $data = [];
        $data['name'] = $model->name;
        $data['limit'] = $model->limit;
        return response()->json([
            'success' => 1,
            'data' => $data
        ]);
    }

    public function updateLeaveType(Request $request)
    {
        $update = LeaveType::where('id', $request->input('id_leavetype'))->first();
        $update->name = $request->input('leavetype_name');
        $update->limit = $request->input('limit');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteLeaveType(Request $request)
    {
        $softLeave = LeaveType::where('id', $request->input('id_leavetype'))->first();
        $softLeave->delete_LeaveType = 1;
        $softLeave->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $softLeave->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readLeaveType()
    {
        return view('leavetypes.tableleavetype', [
            'title' => 'Leave Types',
            'title_menu' => 'Leave Types'
        ]);
    }

    public function getLeave()
    {
        $data = LeaveType::where('delete_LeaveType', 0)->get();
        return Datatables::of($data)
        ->addColumn('name', function ($data) {
            return $data->name;
        })
        ->addColumn('limit', function ($data) {
            return $data->limit;
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
