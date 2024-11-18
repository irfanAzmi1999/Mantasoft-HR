<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Holiday;
use App\Models\LeaveDetail;
use Illuminate\Support\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function landing()
    {
        // $model = Holiday::where('start_date', '>', date('Y-m-d H:i:s'))->where('delete_holiday', 0)->first();
        // $userLeaveToday = LeaveDetail::where('delete_leaveDetail', 0)
        // ->whereIn('status_id', [1,2])
        // ->where('start_date', 'like', Carbon::now()->format('Y-m-d').'%')
        // ->get();
        // if ($model != null) {
        // return view('welcome', [
        //     'name' => $model->name,
        //     'start_date' => $model->start_date,
        //     'userLeaveToday' => $userLeaveToday
        // ]);
        // } else {
        //     return view('welcome', [
        //         'userLeaveToday' => $userLeaveToday
        //     ]);
        // }
        return view('auth.login');
    }
}