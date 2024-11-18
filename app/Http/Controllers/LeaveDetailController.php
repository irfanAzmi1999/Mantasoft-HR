<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveDetail;
use App\Models\LeaveQuota;
use App\Models\Staff;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class LeaveDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function readLeaveDetails()
    {
        return view('leaveDetail.mainLeaveDetail', [
            'title' => 'Leave Details',
            'title_menu' => 'Leave Details'
        ]);
    }

    public function getLeaveDetails()
    {
        $data = LeaveQuota::join('staffs', 'staffs.id', '=', 'leavequotas.staff_id')
        ->whereNot('staffs.user_id', 1)
        ->where('leavequotas.delete_quota', 0)
        ->get();
        return DataTables::of($data)
        ->addColumn('name', function ($data) {
            return $data->getStaff->getUser->name;
        })
        ->addColumn('department_id', function ($data) {
            return $data->getStaff->getDepartment->name;
        })
        ->addColumn('employ_date', function ($data) {
            return date('d M Y', strtotime($data->getStaff->employ_date));
        })
        ->addColumn('taken/balance', function ($data) {
            if (str_contains($data->taken, '.0') || str_contains($data->balance, '.0')) {
                return str_replace('.0', '', $data->taken) . ' / ' . str_replace('.0', '', $data->balance);
            } else {
                return $data->taken . ' / ' . $data->balance;
            }
        })
        ->addColumn('mc_taken/balance', function ($data) {
            if (str_contains($data->mc_taken, '.0') || str_contains($data->mc_balance, '.0')) {
                return str_replace('.0', '', $data->mc_taken) . ' / ' . str_replace('.0', '', $data->mc_balance);
            } else {
                return $data->mc_taken . ' / ' . $data->mc_balance;
            }
        })
        ->addColumn('action', function ($data) {
            return
            '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->staff_id.'">
                <i class="fa-regular fa-eye"></i>
            </button>';
        })
        ->rawColumns(['action'])
        ->escapeColumns([])
        ->make(true);
    }

    public function getLeaveDetailsForHod()
    {
        $data = LeaveQuota::select('leavequotas.*')
        ->join('staffs', 'staffs.id', '=', 'leavequotas.staff_id')
        ->whereNot('staffs.user_id', 1)
        ->where('staffs.superior_id', Auth::user()->id)
        ->where('leavequotas.delete_quota', 0)
        ->get();
        return DataTables::of($data)
        ->addColumn('name', function ($data) {
            return $data->getStaff->getUser->name;
        })
        ->addColumn('department_id', function ($data) {
            return $data->getStaff->getDepartment->name;
        })
        ->addColumn('employ_date', function ($data) {
            return date('d M Y', strtotime($data->getStaff->employ_date));
        })
        ->addColumn('taken/balance', function ($data) {
            if (str_contains($data->taken, '.0') || str_contains($data->balance, '.0')) {
                return str_replace('.0', '', $data->taken) . ' / ' . str_replace('.0', '', $data->balance);
            } else {
                return $data->taken . ' / ' . $data->balance;
            }
        })
        ->addColumn('mc_taken/balance', function ($data) {
            if (str_contains($data->mc_taken, '.0') || str_contains($data->mc_balance, '.0')) {
                return str_replace('.0', '', $data->mc_taken) . ' / ' . str_replace('.0', '', $data->mc_balance);
            } else {
                return $data->mc_taken . ' / ' . $data->mc_balance;
            }
        })
        ->addColumn('action', function ($data) {
            return
            '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->staff_id.'">
                <i class="fa-regular fa-eye"></i>
            </button>';
        })
        ->rawColumns(['action'])
        ->escapeColumns([])
        ->make(true);
    }

    public function openLeaveDetail(Request $request)
    {
        $model = Staff::where('id', $request->input('id_staff'))->first();
        $data = [];
        $data['staff_username'] = $model->getUser->username;
        $data['staff_name'] = $model->getUser->name;
        $data['department'] = $model->getDepartment->name;
        return response()->json([
            'success' => 1,
            'data' => $data
        ]);
    }

    public function getLeaveDetail($id_staff)
    {
        $data = LeaveDetail::where('staff_id', $id_staff)
        ->whereIn('status_id', [1, 2])
        ->where('delete_leaveDetail', 0)
        ->get();
        return DataTables::of($data)
        ->addColumn('id', function ($data) {
            return $data->id;
        })
        ->addColumn('leavetype_id', function ($data) {
            return $data->getLeaveType->name;
        })
        ->addColumn('half_day', function ($data) {
            if ($data->half_day == 0) {
                return 'HALF DAY MORNING';
            } elseif ($data->half_day == 1) {
                return 'HALF DAY EVENING';
            } elseif ($data->half_day == 2) {
                return 'FULL DAY';
            }
        })
        ->addColumn('start_date', function ($data) {
            return date('D, d M Y', strtotime($data->start_date));
        })
        ->addColumn('end_date', function ($data) {
            return date('D, d M Y', strtotime($data->end_date));
        })
        ->addColumn('date_leave', function ($data) {
            if (str_contains($data->date_leave, '.0')) {
                return str_replace('.0', '', $data->date_leave);
            } else {
                return $data->date_leave;
            }
        })
        ->make(true);
    }
}
