<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Relations;
use Yajra\DataTables\DataTables;

class RelationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createRelation(Request $request)
    {
        $insert = new Relations();
        $insert->name = $request->input('contRel_name');
        $insert->delete_relation = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function updateRelations(Request $request)
    {
        $read = Relations::where('id', $request->input('contRelation_id'))->first();
        return response()->json([
            'success' => 1,
            'name' => $read->name
        ]);
    }

    public function updateRelationData(Request $request)
    {
        $update = Relations::where('id', $request->input('contRelation_id'))->first();
        $update->name = $request->input('contRel_name');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDelete(Request $request)
    {
        $relations = Relations::where('id', $request->input('contRelation_id'))->first();
        $relations->delete_relation = 1;
        $relations->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $relations->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function read()
    {
        return view("relations.mainRelations", [
            'title' => 'Relations',
            'title_menu' => 'Relations'
        ]);
    }

    public function get_relation()
    {
        $data = Relations::where('delete_relation', 0)->get();
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
