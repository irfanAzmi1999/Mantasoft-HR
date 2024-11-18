<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Blood;
use Yajra\DataTables\DataTables;

class BloodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createBlood(Request $request)
    {
        $insert = new Blood();
        $insert->name = $request->input('bloodType');
        $insert->delete_blood = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editBlood(Request $request)
    {
        $model = Blood::where('id', $request->input('idUpdate_bloods'))->first();
        return response()->json([
            'success' => 1,
            'name' => $model->name
        ]);
    }

    public function updateBlood(Request $request)
    {
        $update = Blood::where('id', $request->input('idUpdate_bloods'))->first();
        $update->name = $request->input('name');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteBlood(Request $request)
    {
        $delete = Blood::where('id', $request->input('idUpdate_bloods'))->first();
        $delete->delete_blood = 1;
        $delete->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $delete->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readBlood()
    {
        return view('bloods.tableblood', [
            'title' => 'Blood Types',
            'title_menu' => 'Bloods'
        ]);
    }

    public function getBloods()
    {
        $data = Blood::where('delete_blood', 0)->get();
        return Datatables::of($data)
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
