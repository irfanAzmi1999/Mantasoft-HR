<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Status;
use App\Models\Category;
use Yajra\DataTables\DataTables;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createStatus(Request $request)
    {
        $insert = new Status();
        $insert->category_id = $request->input('category_id');
        $insert->name = $request->input('status_name');
        $insert->delete_status = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editStatus(Request $request)
    {
        $model = Status::where('id', $request->input('id_status'))->first();
        $data = [];
        $data['name'] = $model->name;
        $data['category_id'] = $model->category_id;
        return response()->json([
            'success' => 1,
            'data' => $data
        ]);
    }

    public function updateStatus(Request $request)
    {
        $update = Status::where('id', $request->input('id_status'))->first();
        $update->category_id = $request->input('category_id');
        $update->name = $request->input('status_name');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteStatus(Request $request)
    {
        $relations = Status::where('id', $request->input('id_status'))->first();
        $relations->delete_status = 1;
        $relations->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $relations->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readStatus()
    {
        $category = Category::all();
        return view('statuses.tablestatus', [
            'title' => 'Statuses',
            'title_menu' => 'Statuses',
            'category' => $category
        ]);
    }

    public function getStatus()
    {
        $data = Status::where('delete_status', 0)->get();
        return DataTables::of($data)
        ->addColumn('category_id', function ($data) {
            return $data->getCategory->name;
        })
        ->addColumn('name', function ($data) {
            return $data->name;
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
