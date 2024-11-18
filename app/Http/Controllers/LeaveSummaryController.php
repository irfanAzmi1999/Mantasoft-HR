<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\LeaveQuota;
use Yajra\DataTables\DataTables;

class LeaveSummaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function readAllSummary()
    {
        return view('leaveSummary.mainLeaveSummary', [
            'title' => 'Leave Summary',
            'title_menu' => 'Summaries'
        ]);
    }

    public function getAllSummary()
    {
        $data = LeaveQuota::whereNot('staff_id', 1)
        ->where('leavequotas.delete_quota', 0)
        ->get();
        return DataTables::of($data)
        ->addColumn('name', function ($data) {
            return $data->getStaff->getUser->name;
        })
        ->addColumn('department_id', function ($data) {
            return $data->getStaff->getDepartment->name;
        })
        ->addColumn('balance/default', function ($data) {
            if (str_contains($data->balance, '.0') || str_contains($data->default, '.0')) {
                return str_replace('.0', '', $data->balance) . ' / ' . str_replace('.0', '', $data->default);
            } else {
                return $data->balance . ' / ' . $data->default;
            }
        })
        ->addColumn('taken', function ($data) {
            if (str_contains($data->taken, '.0')) {
                return str_replace('.0', '', $data->taken);
            } else {
                return $data->taken;
            }
        })
        ->addColumn('mc_balance/mc_default', function ($data) {
            if (str_contains($data->mc_balance, '.0') || str_contains($data->mc_default, '.0')) {
                return str_replace('.0', '', $data->mc_balance) . ' / ' . str_replace('.0', '', $data->mc_default);
            } else {
                return $data->mc_balance . ' / ' . $data->mc_default;
            }
        })
        ->addColumn('mc_taken', function ($data) {
            if (str_contains($data->mc_taken, '.0')) {
                return str_replace('.0', '', $data->mc_taken);
            } else {
                return $data->mc_taken;
            }
        })
        ->addColumn('action', function ($data) {
            return
            '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->id.'">
            <i class="fa-regular fa-eye"></i>
            </button>';
        })
        ->rawColumns(['action'])
        ->escapeColumns([])
        ->make(true);
    }

    public function openSummary(Request $request)
    {
        $model = LeaveQuota::where('id', $request->input('id_quota'))->first();
        $data = [];
        $data['staff_username'] = $model->getStaff->getUser->username;
        $data['staff_name'] = $model->getStaff->getUser->name;
        if (str_contains($model->default, '.0')) {
            $data['default'] = str_replace('.0', '', $model->default);
        } else {
            $data['default'] = $model->default;
        }
        if (str_contains($model->taken, '.0')) {
            $data['taken'] = str_replace('.0', '', $model->taken);
        } else {
            $data['taken'] = $model->taken;
        }
        if (str_contains($model->balance, '.0')) {
            $data['balance'] = str_replace('.0', '', $model->balance);
        } else {
            $data['balance'] = $model->balance;
        }
        if (str_contains($model->mc_default, '.0')) {
            $data['mc_default'] = str_replace('.0', '', $model->mc_default);
        } else {
            $data['mc_default'] = $model->mc_default;
        }
        if (str_contains($model->mc_taken, '.0')) {
            $data['mc_taken'] = str_replace('.0', '', $model->mc_taken);
        } else {
            $data['mc_taken'] = $model->mc_taken;
        }
        if (str_contains($model->mc_balance, '.0')) {
            $data['mc_balance'] = str_replace('.0', '', $model->mc_balance);
        } else {
            $data['mc_balance'] = $model->mc_balance;
        }
        return response()->json([
            'success' => 1,
            'data' => $data
        ]);
    }
}
