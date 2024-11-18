<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Marital;
use Yajra\DataTables\DataTables;

class MaritalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createMarital(Request $request)
    {
        $insert = new Marital();
        $insert->name = $request->input('marital_name');
        $insert->delete_marital = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editMarital(Request $request)
    {
        $model = Marital::where('id', $request->input('idCont_maritals'))->first();
        return response()->json([
            'success' => 1,
            'name' => $model->name
        ]);
    }

    public function updateMarital(Request $request)
    {
        $update = Marital::where('id', $request->input('idCont_maritals'))->first();
        $update->name = $request->input('name');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteMar(Request $request)
    {
        $mar = Marital::where('id', $request->input('idCont_maritals'))->first();
        $mar->delete_marital = 1;
        $mar->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $mar->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readMarital()
    {
        return view('maritals.tablemarital', [
            'title' => 'Maritals',
            'title_menu' => 'Maritals'
        ]);
    }

    public function getMarital()
    {
        $data = Marital::where('delete_marital', 0)->get();
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
