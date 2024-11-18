<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Marriage;
use App\Models\Marital;
use App\Models\Profile;
use Yajra\DataTables\DataTables;

class MarriageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createMarriage(Request $request)
    {
        $insert = new Marriage();
        $insert->profile_id = $request->input('profile_id');
        $insert->marital_id = $request->input('marital_id');
        $date = $request->input('marriage_date');
        if ($date != '') {
            $insert->marriage_date = date('Y-m-d', strtotime($date));
        } else {
            $insert->marriage_date = null;
        }
        $insert->spouse_name = $request->input('spouse_name');
        $insert->spouse_job = $request->input('spouse_job');
        $insert->spouse_company = $request->input('spouse_company');
        $insert->delete_marriage = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editMarriage(Request $request)
    {
        $model = Marriage::where('id', $request->input('id_marriage'))->first();
        $data = [];
        $data['profile_id'] = $model->profile_id;
        $data['marital_id'] = $model->marital_id;
        $date = $model->marriage_date;
        if ($date != '') {
            $data['marriage_date'] = date('d-m-Y', strtotime($date));
        } else {
            $data['marriage_date'] = '';
        }
        $data['spouse_name'] = $model->spouse_name;
        $data['spouse_job'] = $model->spouse_job;
        $data['spouse_company'] = $model->spouse_company;
        return response()->json([
            'success' => 1,
            'data' => $data
        ]);
    }

    public function updateMarriage(Request $request)
    {
        $update = Marriage::where('id', $request->input('id_marriage'))->first();
        $update->profile_id = $request->input('profile_id');
        $update->marital_id = $request->input('marital_id');
        $date = $request->input('marriage_date');
        if ($date != '') {
            $update->marriage_date = date('Y-m-d', strtotime($date));
        } else {
            $update->marriage_date = null;
        }
        $update->spouse_name = $request->input('spouse_name');
        $update->spouse_job = $request->input('spouse_job');
        $update->spouse_company = $request->input('spouse_company');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteMarriage(Request $request)
    {
        $softdelete = Marriage::where('id', $request->input('id_marriage'))->first();
        $softdelete->delete_marriage = 1;
        $softdelete->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $softdelete->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readMarriage($id)
    {
        $model = Profile::where('id', $id)->get();
        $marital = Marital::all();
        return view('marriages.tablemarriage', [
            'title' => 'My Marriages',
            'title_menu' => 'Marriages',
            'profile_id' => $id,
            'id' => $id,
            'model' => $model,
            'marital' => $marital
        ]);
    }

    public function getMarriage($id)
    {
        $data = Marriage::where('profile_id', $id)->where('delete_marriage', 0)->get();
        return DataTables::of($data)
        ->addColumn('marital_id', function ($data) {
            return $data->getMarital->name;
        })
        ->addColumn('marriage_date', function ($data) {
            return $data->marriage_date ? date('d M Y', strtotime($data->marriage_date)) : '-';
        })
        ->addColumn('spouse_name', function ($data) {
            return $data->spouse_name ? $data->spouse_name : '-';
        })
        ->addColumn('spouse_job', function ($data) {
            return $data->spouse_job ? $data->spouse_job : '-';
        })
        ->addColumn('spouse_company', function ($data) {
            return $data->spouse_company ? $data->spouse_company : '-';
        })
        ->addColumn('action', function ($data) {
            return
            '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->id.'">
                <i class="fa-regular fa-pen-to-square"></i>
            </button>
            <button class="btn btn-icon btn-danger for-delete" data-id="'.$data->id.'" data-marriage='.$data->getMarital->name.'>
                <i class="fa-regular fa-trash-can"></i>
            </button>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
