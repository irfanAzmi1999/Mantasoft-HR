<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Department;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createDepartment(Request $request)
    {
        $insert = new Department();
        $insert->name = $request->input('department_name');
        $insert->fullname = $request->input('fullname');
        $insert->order_number = $request->input('order_number');
        $insert->delete_department = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editDepartment(Request $request)
    {
        $model = Department::where('id', $request->input('id_department'))->first();
        $data = [];
        $data['name'] = $model->name;
        $data['fullname'] = $model->fullname;
        $data['order_number'] = $model->order_number;
        return response()->json([
            'success' => 1,
            'data' => $data
        ]);
    }

    public function updateDepartment(Request $request)
    {
        $update = Department::where('id', $request->input('id_department'))->first();
        $update->name = $request->input('department_name');
        $update->fullname = $request->input('fullname');
        $update->order_number = $request->input('order_number');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteDepartment(Request $request)
    {
        $department = Department::where('id', $request->input('id_department'))->first();
        $department->delete_department = 1;
        $department->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $department->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readDepartment()
    {
        return view('departments.tabledepartment', [
            'title' => 'Departments',
            'title_menu' => 'Departments'
        ]);
    }

    public function getDepartment()
    {
        $data = Department::where('delete_department', 0)->get();
        return Datatables::of($data)
        ->addColumn('name', function ($data) {
            return $data->name;
        })
        ->addColumn('fullname', function ($data) {
            return $data->fullname;
        })
        ->addColumn('order_number', function ($data) {
            return $data->order_number;
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
