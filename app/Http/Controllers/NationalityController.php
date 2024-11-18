<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Nationality;
use Yajra\DataTables\DataTables;

class NationalityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createNationality(Request $request)
    {
        $insert = new Nationality();
        $insert->name = $request->input('nationalityName');
        $insert->delete_nationality = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editNationality(Request $request)
    {
        $model = Nationality::where('id', $request->input('idUpdate_nat'))->first();
        return response()->json([
            'success' => 1,
            'name' => $model->name
        ]);
    }

    public function updateNationality(Request $request)
    {
        $update = Nationality::where('id', $request->input('idUpdate_nat'))->first();
        $update->name = $request->input('name');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteNat(Request $request)
    {
        $softdelete = Nationality::where('id', $request->input('idUpdate_nat'))->first();
        $softdelete->delete_nationality = 1;
        $softdelete->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $softdelete->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readNationality()
    {
        return view('nationalities.tablenationality', [
            'title' => 'Nationalities',
            'title_menu' => 'Nationalities'
        ]);
    }

    public function get_national()
    {
        $data = Nationality::where('delete_nationality', 0)->get();
        return Datatables::of($data)
        ->addColumn('name', function ($data) {
            return $data->name;
        })
        ->addColumn('action', function ($data) {
            return
            '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->id .'">
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
