<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Overtime;
use App\Models\OvertimeApplication;

class OvertimeAppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mainOvertimeApp()
    {
        $user = User::where('id', Auth::user()->id)->get();
        return view('overtimeApplication.overtimeApplication', [
            'title' => 'Overtime Application',
            'title_menu' => 'overtimeApp',
            'user' => $user
            
        ]);
    }

    public function createOvertimeApp(Request $request)
    {
        $insert = new OvertimeApplication();
        $insert->user_id = $request->input('user_id');
        $insert->date = date('Y-m-d',strtotime($request->input('date')));
        $insert->time_in = date('H:i:s',strtotime($request->input('time_in')));
        $insert->time_out = date('H:i:s',strtotime($request->input('time_out')));
        $insert->time_out = date('H:i:s', strtotime($insert->time_in. ' + 4 hours'));
        $insert->latitude = $request->input('latitude');
        $insert->longitude = $request->input('longitude');
        $insert->location = $request->input('location');
        $insert->save();
        return redirect('listOvertime/'.Auth::user()->id);
    }
}
