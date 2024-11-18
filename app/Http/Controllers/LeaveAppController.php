<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Jobs\LeaveAppJob;
use App\Mail\LeaveAppMail;
use App\Models\LeaveDetail;
use App\Models\attachment;
use App\Models\EmergencyType;
use App\Models\LeaveType;
use App\Models\LeaveQuota;
use App\Models\Staff;

class LeaveAppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mainLeaveApp()
    {
        $emergency = EmergencyType::where('delete_emergencytype', 0)->get();
        $leaveType = LeaveType::where('delete_leavetype', 0)->get();
        $quota = LeaveQuota::where('staff_id', Auth::user()->getStaff->id)->get();
        $staff = Staff::where('user_id', Auth::user()->id)->get();
        return view('leaveApplication.mainLeaveApp', [
            'title' => 'Leave Application',
            'title_menu' => 'leaveApp',
            'emergency' => $emergency,
            'model' => $leaveType,
            'quota' => $quota,
            'staff' => $staff
        ]);
    }

    public function createLeaveApp(Request $request)
    {

        //check role dulu kalau BOD status = approve

        $currentUser = Auth::user()->id;
        $usermodel = User::find($currentUser);
        $userRole = $usermodel->getRoleUser->role_id;

//        dd($userRole);



        $insert = new LeaveDetail();
        $insert->staff_id = $request->input('staff_id');
        $insert->leavetype_id = $request->input('leavetype_id');
        $insert->emergencytype_id = $request->input('emergencytype_id');
         //apakah ini
        if ($userRole == 1 || $userRole == 2 || $userRole == 6)
        {
            $insert->status_id = 2;
        }
        else{
            $insert->status_id = 3;
        }

        $insert->apply_date = Carbon::now()->format('Y-m-d H:i:s');
        $insert->half_day = $request->input('half_day');
        if ($insert->half_day == 0) {
            $insert->start_date = date('Y-m-d H:i:s', strtotime($request->input('start_date').'09:00:00'));
            $insert->end_date = date('Y-m-d H:i:s', strtotime($request->input('end_date').'18:00:00'));
        } elseif ($insert->half_day == 1) {
            $insert->start_date = date('Y-m-d H:i:s', strtotime($request->input('start_date').'09:00:00'));
            $insert->end_date = date('Y-m-d H:i:s', strtotime($request->input('end_date').'14:00:00'));
        } elseif ($insert->half_day == 2) {
            $insert->start_date = date('Y-m-d H:i:s', strtotime($request->input('start_date').'14:00:00'));
            $insert->end_date = date('Y-m-d H:i:s', strtotime($request->input('end_date').'18:00:00'));
        }
        if (str_contains($request->input('date_leave'), '.0')) {
            $insert->date_leave = str_replace('.0', '', $request->input('date_leave'));
        } else {
            $insert->date_leave = $request->input('date_leave');
        }
        //$insert->date_leave = $request->input('date_leave');
        $insert->delete_leavedetail = 0;
        $insert->staff_remarks = $request->input('staff_remarks');

        $insert->save();

        if ($request->hasFile('attachments')) {

            $upload = $request->file('attachments');
            $count = count($upload);
            for ($i = 0; $i < $count; $i++) {
                $leave = $upload[$i]->leave_id = $insert->id;
                $name = $upload[$i]->getClientOriginalName();
                $type = $upload[$i]->getMimeType();
                $size = $upload[$i]->getSize();
                $delete = $upload[$i]->delete_attachment = 0;
                $path = 'images/attachments/';
                $upload[$i]->move($path, $name);
                $attach = new Attachment;
                $attach->leave_id = $leave;
                $attach->name = $name;
                $attach->type = $type;
                $attach->size = $size;
                $attach->delete_attachment = $delete;
                $attach->save();
            }
        }


        if (!($userRole == 1 || $userRole == 2 || $userRole == 6))
        {
            $superior = $insert->getStaff->getSuperior->email;
            LeaveAppJob::dispatch($insert, $superior);
        }




        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        // die();
        return redirect('MyLeave/'.Auth::user()->getStaff->id);
    }
}
