<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveDetail;
use App\Models\LeaveQuota;
use App\Models\Staff;
use Yajra\DataTables\DataTables;

class LeaveUnpaidController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function readAllUnpaid()
    {
        $currentYear = date('Y');
        return view('leaveUnpaid.mainLeaveUnpaid', [
            'title' => 'Unpaid Leave',
            'title_menu' => 'Unpaids',
            'currentYear' => $currentYear
        ]);
    }

    public function getAllUnpaid()
    {
        $data = Staff::with('getUser', 'getDepartment', 'getLeaveQuota', 'getLeaveDetail')
        ->whereNot('user_id', 1)
        ->get()
        ->toArray();
        return DataTables::of($data)
        ->addColumn('name', function ($data) {
            return $data['get_user']['name'];
        })
        ->addColumn('department_id', function ($data) {
            return $data['get_department']['name'];
        })
        ->addColumn('unpaid', function ($data) {
            $sum = 0;
            if (count($data['get_leave_detail']) > 0) {
                foreach ($data['get_leave_detail'] as $d) {
                    if (($d['leavetype_id'] == 9 && $d['status_id'] == 1) || $d['status_id'] == 2) {
                        $sum += $d['date_leave'];
                    }
                }
            }
            return $sum;
        })
        ->addColumn('action', function ($data) {
            return
            '<button class="btn btn-icon btn-warning for-update" data-id="'.$data['id'].'">
                <i class="fa-regular fa-eye"></i>
            </button>';
        })
        ->rawColumns(['action'])
        ->escapeColumns([])
        ->make(true);
    }

    public function openUnpaid(Request $request)
    {
        $model = Staff::where('id', $request->input('id_staff'))->first();
        $user = [];
        $user['staff_username'] = $model->getUser->username;
        $user['staff_name'] = $model->getUser->name;
        $data = LeaveDetail::where('staff_id', $request->input('id_staff'))
        ->whereIn('status_id', [1, 2])
        ->where('leavetype_id', 9)
        ->get();
        $month = [
            1 => ['no' => 1, 'monthTitle' => 'JANUARY', 'sum' => 0],
            2 => ['no' => 2, 'monthTitle' => 'FEBRUARY', 'sum' => 0],
            3 => ['no' => 3, 'monthTitle' => 'MARCH', 'sum' => 0],
            4 => ['no' => 4, 'monthTitle' => 'APRIL', 'sum' => 0],
            5 => ['no' => 5, 'monthTitle' => 'MAY', 'sum' => 0],
            6 => ['no' => 6, 'monthTitle' => 'JUNE', 'sum' => 0],
            7 => ['no' => 7, 'monthTitle' => 'JULY', 'sum' => 0],
            8 => ['no' => 8, 'monthTitle' => 'AUGUST', 'sum' => 0],
            9 => ['no' => 9, 'monthTitle' => 'SEPTEMBER', 'sum' => 0],
            10 => ['no' => 10, 'monthTitle' => 'OCTOBER', 'sum' => 0],
            11 => ['no' => 11, 'monthTitle' => 'NOVEMBER', 'sum' => 0],
            12 => ['no' => 12, 'monthTitle' => 'DECEMBER', 'sum' => 0]
        ];
        foreach ($data as $d) {
            $m = date('m', strtotime($d->start_date));
            $month[$m]['sum'] += $d->date_leave;
        }
        return response()->json([
            'success' => 1,
            'data' => $month,
            'user' => $user
        ]);
    }
}
