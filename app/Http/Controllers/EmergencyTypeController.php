<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\EmergencyType;
use Yajra\DataTables\DataTables;

class EmergencyTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createEmergencyType(Request $request)
    {
        $insert = new EmergencyType();
        $insert->name = $request->input('emergencytype_name');
        $insert->delete_emergencytype = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editEmergencyType(Request $request)
    {
        $model = EmergencyType::where('id', $request->input('id_emergencytype'))->first();
        return response()->json([
            'success' => 1,
            'name' => $model->name
        ]);
    }

    public function updateEmergencyType(Request $request)
    {
        $update = EmergencyType::where('id', $request->input('id_emergencytype'))->first();
        $update->name = $request->input('emergencytype_name');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteEmer(Request $request)
    {
        $emer = EmergencyType::where('id', $request->input('id_emergencytype'))->first();
        $emer->delete_emergencytype = 1;
        $emer->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $emer->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readEmergencyType()
    {
        return view('emergencytypes.tableemergencytype', [
            'title' => 'Emergency Types',
            'title_menu' => 'Emergency Types'
        ]);
    }

    public function getEmergencyType()
    {
        $data = EmergencyType::where('delete_emergencytype', 0)->get();
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
