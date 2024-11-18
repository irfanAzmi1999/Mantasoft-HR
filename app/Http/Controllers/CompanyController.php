<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Company;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createCompany(Request $request)
    {
        $insert = new Company();
        $insert->name = $request->input('companyCont');
        $insert->delete_company = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editCompany(Request $request)
    {
        $model = Company::where('id', $request->input('contCompany_id'))->first();
        return response()->json([
            'success' => 1,
            'name' => $model->name
        ]);
    }

    public function updateCompany(Request $request)
    {
        $update = Company::where('id', $request->input('contCompany_id'))->first();
        $update->name = $request->input('companyCont');
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteCompany(Request $request)
    {
        $company = Company::where('id', $request->input('contCompany_id'))->first();
        $company->delete_company = 1;
        $company->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $company->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readCompany()
    {
        return view('companies.tablecompany', [
            'title' => 'Companies',
            'title_menu' => 'Companies'
        ]);
    }

    public function getCompany()
    {
        $data = Company::where('delete_company', 0)->get();
        return Datatables::of($data)
        ->addColumn('name', function ($data) {
            return $data->name;
        })
        ->addColumn('action', function ($data) {
            return
            '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->id.'">
                <i class="fa-regular fa-pen-to-square"></i>
            </button>
            <button class="btn btn-icon btn-danger for-delete" data-id="'.$data->id .'">
                <i class="fa-regular fa-trash-can"></i>
            </button>';
        })
        ->rawColumns(['action'])
        ->make(true);       
    }
}
