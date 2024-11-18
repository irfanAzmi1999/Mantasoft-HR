<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Attachment;
use App\Models\Company;
use App\Models\Education;
use App\Models\Department;
use App\Models\LeaveDetail;
use App\Models\LeaveQuota;
use App\Models\Marriage;
use App\Models\Profile;
use App\Models\ProfilePosition;
use App\Models\Relatives;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Staff;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listAllUser()
    {
        $company = Company::all();
        $department = Department::all();
        $hod = Staff::where('user_id', Auth::user()->id)->first();
        $role = Role::all();
        $superior = RoleUser::whereIn('role_id', [1, 2, 3])->get();
        return view('users.listusers', [
            'title' => 'List Staff',
            'title_menu' => 'Staffs',
            'company' => $company,
            'department' => $department,
            'hod' => $hod,
            'role' => $role,
            'superior' => $superior
        ]);
    }

    public function getAllUser()
    {
        $data = User::select('users.*')
        ->join('role_user', 'role_user.user_id', '=', 'users.id')
        ->whereNot('users.id', 1)
        ->where('users.delete_user', 0)
        // ->orderByRaw('CASE
        //     WHEN role_id <> 2 THEN 1
        //     WHEN role_id <> 1 THEN 2
        //     WHEN role_id <> 3 THEN 3
        //     WHEN role_id <> 5 THEN 4
        //     WHEN role_id <> 4 THEN 5
        //     ELSE 0
        // END DESC')
        ->get();
        return DataTables::of($data)
        ->addColumn('name', function ($data) {
            return 
            '<a href="'.url('/').'/editProfile/'.$data->id.'" class="btn" style="color:blue;text-decoration: underline">'.$data->name.'</a>';
        })
        ->addColumn('email', function ($data) {
            return $data->email;
        })
        ->addColumn('role', function ($data) {
            // return
            // '<p style="font-family: Impact, cursive; font-size: 16px; margin: auto;">'
            //     .$data->getRoleUser->getRole->display_name.
            // '</p>';
            return
            $data->getRoleUser->getRole->display_name;
        })
        ->addColumn('dept-super', function ($data) {
            // return
            // '<h6>
            //     <span class="badge bg-primary" style="margin: auto;">'
            //         .($data->getStaff->getDepartment ? $data->getStaff->getDepartment->name : null).
            //     '</span>
            // </h6>
            // <h6>
            //     <span class="badge bg-info" style="margin: auto;">'
            //         .($data->getStaff->superior_id ? $data->getStaff->getSuperior->name : null).
            //     '</span>
            // </h6>';
            return
            '
                <span class="">'
                    .($data->getStaff->getDepartment ? $data->getStaff->getDepartment->name : null).
                '</span>
            
                <br>
                <span class="">'
                    .($data->getStaff->superior_id ? $data->getStaff->getSuperior->name : null).
                '</span>
            ';
        })
        ->addColumn('phone', function ($data) {
            return $data->getProfile->phone;
        })
        ->addColumn('action', function ($data) {
            // return
            // '<a data-staff-id="'.$data->id.'" data-user-id="'.$data->id.'" type="button" class="for-update-user btn btn-icon btn-warning">
            //     <i class="fa-regular fa-pen-to-square"></i>
            // </a>
            // <a href="'.url('/').'/editProfile/'.$data->id.'" type="button" class="btn btn-icon btn-success">
            //     <i class="fa-solid fa-id-badge"></i>
            // </a>
            // <div class="d-inline-block">
            //     <!-- Button trigger modal -->
            //     <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#danger'.$data->id.'">
            //         <i class="fa-regular fa-trash-can"></i>
            //     </button>
            //     <!-- Modal -->
            //     <div class="modal fade modal-danger text-start" id="danger'.$data->id.'" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
            //         <div class="modal-dialog modal-dialog-centered">
            //             <div class="modal-content">
            //                 <div class="modal-header">
            //                     <h5 class="modal-title" id="myModalLabel120">Delete "'.$data->name.'"?</h5>
            //                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            //                 </div>
            //                 <div class="modal-body">
            //                     Do you want to delete user '.$data->name.'?
            //                 </div>
            //                 <div class="modal-footer">
            //                     <a href="'.url('/').'/softDeleteUser/'.$data->id.'" class="btn btn-danger">Delete</a>
            //                 </div>
            //             </div>
            //         </div>
            //     </div>
            // </div>';
            return
            '<div class="d-inline-block">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#danger'.$data->id.'">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade modal-danger text-start" id="danger'.$data->id.'" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel120">Delete "'.$data->name.'"?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Do you want to delete user '.$data->name.'?
                            </div>
                            <div class="modal-footer">
                                <a href="'.url('/').'/softDeleteUser/'.$data->id.'" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        })
        ->rawColumns(['action'])
        ->escapeColumns([])
        ->make(true);
    }

    public function getUserUnderHod()
    {
        $data = User::select('users.*')
        ->join('staffs', 'staffs.user_id', '=', 'users.id')
        ->join('role_user', 'role_user.user_id', '=', 'users.id')
        ->where('staffs.department_id', Auth::user()->getStaff->getDepartment->id)
        ->where('users.delete_user', 0)
        // ->orderByRaw(
        //     'CASE
        //         WHEN role_id <> 3 THEN 1
        //         WHEN role_id <> 5 THEN 2
        //         WHEN role_id <> 4 THEN 3
        //         ELSE 0
        //     END DESC'
        // )
        ->get();
        return DataTables::of($data)
        ->addColumn('name', function ($data) {
            return $data->name;
        })
        ->addColumn('email', function ($data) {
            return $data->email;
        })
        ->addColumn('role', function ($data) {
            return
            '<p style="font-family: Impact, cursive; font-size: 16px; margin: auto;">'
                .$data->getRoleUser->getRole->display_name.
            '</p>';
        })
        ->addColumn('dept', function ($data) {
            return
            '<h6>
                <span class="badge bg-primary" style="margin: auto;">'
                    .($data->getStaff->getDepartment ? $data->getStaff->getDepartment->name : null).
                '</span>
            </h6>';
        })
        ->addColumn('phone', function ($data) {
            return $data->getProfile->phone;
        })
        ->addColumn('action', function ($data) {
            return
            '<a data-staff-id="'.$data->id.'" data-user-id="'.$data->id.'" type="button" class="for-update-user btn btn-icon btn-warning">
                <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <a href="'.url('/').'/editProfile/'.$data->id.'" type="button" class="btn btn-icon btn-success">
                <i class="fa-solid fa-id-badge"></i>
            </a>
            <div class="d-inline-block">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#danger'.$data->id.'">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade modal-danger text-start" id="danger'.$data->id.'" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel120">Delete "'.$data->name.'"?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Do you want to delete user '.$data->name.'?
                            </div>
                            <div class="modal-footer">
                                <a href="'.url('/').'/softDeleteUser/'.$data->id.'" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        })
        ->rawColumns(['action'])
        ->escapeColumns([])
        ->make(true);
    }

    public function softDeleteUser($id) {
        $role = RoleUser::where('user_id', $id)->first();
        $role->delete_roleuser = 1;
        $role->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $role->save();

        $education = Education::where('profile_id', $id)->get();
        foreach($education as $e) {
            $e->delete_education = 1;
            $e->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
            $e->save();
        }

        $relative = Relatives::where('profile_id', $id)->get();
        foreach($relative as $r) {
            $r->delete_relative = 1;
            $r->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
            $r->save();
        }

        $marriage = Marriage::where('profile_id', $id)->get();
        foreach($marriage as $m) {
            $m->delete_marriage = 1;
            $m->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
            $m->save();
        }

        $position = ProfilePosition::where('profile_id', $id)->get();
        foreach($position as $po) {
            $po->delete_profileposition = 1;
            $po->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
            $po->save();
        }

        $profile = Profile::where('user_id', $id)->get();
        foreach($profile as $pr) {
            $pr->delete_profile = 1;
            $pr->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
            $pr->save();
        }

        $attach = Attachment::join('leavedetails', 'leavedetails.id', '=', 'attachments.leave_id')
        ->join('staffs', 'staffs.id', '=', 'leavedetails.staff_id')
        ->where('staffs.id', $id)->get();
        foreach($attach as $a) {
            $a->delete_attachment = 1;
            $a->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
            $a->save();
        }

        $leave = LeaveDetail::join('staffs', 'staffs.id', '=', 'leavedetails.staff_id')
        ->where('staffs.id', $id)->get();
        foreach($leave as $l) {
            $l->delete_leave = 1;
            $l->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
            $l->save();
        }

        $quota = LeaveQuota::where('staff_id', $id)->first();
        $quota->delete_quota = 1;
        $quota->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $quota->save();

        $staff = Staff::where('user_id', $id)->first();
        $staff->delete_staff = 1;
        $staff->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $staff->save();

        $user = User::where('id', $id)->first();
        $user->delete_user = 1;
        $user->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->save();

        return redirect('listAllUser');
    }

    public function attendance(){
      $company = Company::all();
      $department = Department::all();
      $hod = Staff::where('user_id', Auth::user()->id)->first();
      $role = Role::all();
      $superior = RoleUser::whereIn('role_id', [1, 2, 3])->get();
      return view('users.attendance', [
          'title' => 'List Staff',
          'title_menu' => 'Staffs',
          'company' => $company,
          'department' => $department,
          'hod' => $hod,
          'role' => $role,
          'superior' => $superior
          ]);
    }

}
