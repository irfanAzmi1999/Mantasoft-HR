<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveQuota;
use App\Models\LeaveDetail;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $leave = LeaveQuota::select('leavequotas.*')
        ->join('staffs', 'staffs.id', '=', 'leavequotas.staff_id')
        ->where('staffs.user_id', Auth::user()->id)
        ->where('leavequotas.delete_quota', 0)
        ->first();

        $leaveApp = LeaveDetail::select('leavedetails')
        ->join('staffs', 'staffs.id', '=', 'leavedetails.staff_id')
        ->where('leavedetails.delete_leavedetail', 0)
        ->where('staffs.user_id', Auth::user()->id)
        ->count();

        $leaveapproved = LeaveDetail::select('leavedetails')
        ->join('staffs', 'staffs.id', '=', 'leavedetails.staff_id')
        ->where('staffs.user_id', Auth::user()->id)
        ->whereIn('status_id', [1, 2])
        ->where('leavedetails.delete_leavedetail', 0)
        ->count();

        $leaveRejected = LeaveDetail::select('leavedetails')
        ->join('staffs', 'staffs.id', '=', 'leavedetails.staff_id')
        ->where('staffs.user_id', Auth::user()->id)
        ->whereIn('status_id', [4, 5])
        ->where('leavedetails.delete_leavedetail', 0)
        ->count();

        $userLeaveApproved = LeaveDetail::where('delete_leaveDetail', 0)
        ->whereIn('status_id', [1, 2])
        ->count();

        $userLeaveRejected = LeaveDetail::where('delete_leaveDetail', 0)
        ->whereIn('status_id', [4, 5])
        ->count();

        $userLeavePending = LeaveDetail::where('delete_leaveDetail', 0)
        ->where('status_id', 3)
        ->count();

        $userLeaveToday = LeaveDetail::where('delete_leaveDetail', 0)
        ->whereIn('status_id', [1, 2])
        ->where('start_date', 'like', Carbon::now()->format('Y-m-d') . '%')
        ->count();

        $underHODApprovedLeave = LeaveDetail::select('leavedetails')
        ->join('staffs', 'staffs.id', '=', 'leavedetails.staff_id')
        ->where('staffs.superior_id', Auth::user()->id)
        ->whereIn('status_id', [1, 2])
        ->where('leavedetails.delete_leavedetail', 0)
        ->count();

        $underHODRejectedLeave = LeaveDetail::select('leavedetails')
        ->join('staffs', 'staffs.id', '=', 'leavedetails.staff_id')
        ->where('staffs.superior_id', Auth::user()->id)
        ->whereIn('status_id', [4, 5])
        ->where('leavedetails.delete_leavedetail', 0)
        ->count();

        $underHODPendingLeave = LeaveDetail::select('leavedetails')
        ->join('staffs', 'staffs.id', '=', 'leavedetails.staff_id')
        ->where('staffs.superior_id', Auth::user()->id)
        ->where('status_id', 3)
        ->where('leavedetails.delete_leavedetail', 0)
        ->count();

        return view('home', [
            'title' => 'Dashboard',
            'title_menu' => 'Dashboard',
            'leave' => $leave,
            'userLeaveApproved' => $userLeaveApproved,
            'userLeavePending' => $userLeavePending,
            'userLeaveRejected' => $userLeaveRejected,
            'userLeaveToday' => $userLeaveToday,
            'leaveapproved' => $leaveapproved,
            'leaveRejected' => $leaveRejected,
            'leaveApp' => $leaveApp,
            'underHODApprovedLeave' => $underHODApprovedLeave,
            'underHODRejectedLeave' => $underHODRejectedLeave,
            'underHODPendingLeave' => $underHODPendingLeave
        ]);
    }
}
