<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Jobs\LeaveApprovalJob;
use App\Mail\LeaveApproveMail;
use App\Mail\LeaveRejectMail;
use App\Models\LeaveDetail;
use App\Models\Attachment;
use App\Models\LeaveQuota;
use App\Models\Status;
use Yajra\DataTables\DataTables;

class LeaveApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function openApproval(Request $request)
    {
        $model = LeaveDetail::where('id', $request->input('id_leave'))->first();
        $data = [];
        $data['staff_name'] = $model->getStaff->getUser->name;
        $data['leavetype_id'] = $model->getLeaveType->name;
        $data['emergencytype_id'] = $model->emergencytype_id;
        $data['status_id'] = $model->status_id;
        $data['start_date'] = date('D, d M Y', strtotime($model->start_date));
        $data['end_date'] = date('D, d M Y', strtotime($model->end_date));
        $data['staff_remarks'] = $model->staff_remarks;
        return response()->json([
            'success' => 1,
            'data' => $data
        ]);
    }

    public function leaveApproval(Request $request)
    {
        $leave = LeaveDetail::where('id', $request->input('id_leave'))->first();
        $leave->status_id = $request->input('status_id');
        switch ($leave->status_id) {
            case 1: case 2:
                $leave->approver_id = $leave->getStaff->superior_id;
                $leave->approver_remarks = $request->input('approver_remarks');
                $quota = LeaveQuota::where('staff_id', $leave->staff_id)->first();
                switch ($leave->leavetype_id) {
                    case 6:
                        switch ($leave->half_day) {
                            case 1: case 2:
                                $quota->mc_taken += 0.5; $quota->mc_balance -= 0.5; break;
                            case 0:
                                $quota->mc_taken += 1; $quota->mc_balance -= 1; break;
                        }
                        break;
                    case 5:
                        $quota->maternity = 60; break;
                    case 7:
                        $quota->paternity = 3; break;
                    case 1: case 2: case 3: case 4: case 8:
                        switch ($leave->half_day) {
                            case 1: case 2:
                                $quota->taken += 0.5; $quota->balance -= 0.5; break;
                            case 0:
                                $quota->taken += 1; $quota->balance -= 1; break;
                        }
                        break;
                }
                $quota->save();
                break;
        }
        $leave->save();
        $staff = $leave->getStaff->getUser->email;
        $superior = $leave->getStaff->getSuperior->getStaff->getSuperior->email ?? $leave->getStaff->getSuperior->email;
        $LA = $leave->status_id;
        LeaveApprovalJob::dispatch($staff, $superior, $LA, $leave);
        return response()->json([
            'success' => 1
        ]);
    }

    public function readAllLeave()
    {
        $status = Status::where('delete_status', 0)->get();
        return view('leaveApproval.mainLeaveApproval', [
            'title' => 'Leave Approval',
            'title_menu' => 'Approvals',
            'status' => $status
        ]);    
        
    }

    public function getAllLeave()
    {
        $data = LeaveDetail::where('delete_leaveDetail', 0)
        ->whereNot('staff_id', Auth::user()->getStaff->id)
        ->get();
        return DataTables::of($data)
        ->addColumn('name', function ($data) {
            return $data->getStaff->getUser->name;
        })
        ->addColumn('department_id', function ($data) {
            return $data->getStaff->getDepartment->name;
        })
        ->addColumn('half_day', function ($data) {
            if ($data->half_day == 1) {
                return 'HALF DAY MORNING';
            } elseif ($data->half_day == 2) {
                return 'HALF DAY EVENING';
            } else {
                return 'FULL DAY';
            }
        })
        ->addColumn('leavetype_id', function ($data) {
            $type = $data->getLeaveType->id;
            $color = '';
            switch ($type) {
                case 1:
                    $color = 'success'; break;
                case 2: case 4:
                    $color = 'secondary'; break;
                case 3:
                    $color = 'danger'; break;
                case 5: case 7:
                    $color = 'primary'; break;
                case 9:
                    $color = 'dark'; break;
                default:
                    $color = 'info'; break;
            }
            return
            '<span class="badge bg-'.$color.' check" id="leave_type" data-id="'.$data->getLeaveType->id.'">'
                .$data->getLeaveType->name.
            '</span>';
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
        ->addColumn('status', function ($data) {
            $status = $data->getStatus->id;
            $status2 = '';
            $color = '';
            switch ($status) {
                case 1: case 2:
                    $color = 'success'; break;
                case 4: case 5:
                    $color = 'danger'; break;
                default:
                    $color = 'warning'; break;
            }
            if ($status == 3) {
                $status2 =
                '<a style="color: white;" class=" badge bg-'.$color.' for-update" data-id="'.$data->id.'">'
                    .$data->getStatus->name.
                '</a>';
            } else {
                $status2 =
                '<p style="color: white;" class=" badge bg-'.$color.' for-update">'
                    .$data->getStatus->name.
                '</p>';
            }
            return $status2;
        })
        ->addColumn('action', function ($data) {
            if ($data->status_id == 3) {
                return
                '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->id.'">
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>';
            }
        })
        ->rawColumns(['action'])
        ->escapeColumns([])
        ->make(true);
    }

    public function getLeaveForHod()
    {
        $data = LeaveDetail::select('leavedetails.*')
        ->join('staffs', 'staffs.id', '=', 'leavedetails.staff_id')
        ->where('staffs.superior_id', Auth::user()->id)
        ->where('leavedetails.delete_leaveDetail', 0)
        ->get();
        return DataTables::of($data)
        ->addColumn('name', function ($data) {
            return $data->getStaff->getUser->name;
        })
        ->addColumn('department_id', function ($data) {
            return $data->getStaff->getDepartment->name;
        })
        ->addColumn('half_day', function ($data) {
            if ($data->half_day == 1) {
                return 'HALF DAY MORNING';
            } elseif ($data->half_day == 2) {
                return 'HALF DAY EVENING';
            } else {
                return 'FULL DAY';
            }
        })
        ->addColumn('leavetype_id', function ($data) {
            $type = $data->getLeaveType->id;
            $color = '';
            switch ($type) {
                case 1:
                    $color = 'success'; break;
                case 2: case 4:
                    $color = 'secondary'; break;
                case 3:
                    $color = 'danger'; break;
                case 5: case 7:
                    $color = 'primary'; break;
                case 9:
                    $color = 'dark'; break;
                default:
                    $color = 'info'; break;
            }
            return
            '<span class="badge bg-'.$color.' check" id="leave_type" data-id="'.$data->getLeaveType->id.'">'
                .$data->getLeaveType->name.
            '</span>';
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
        ->addColumn('status', function ($data) {
            $status = $data->getStatus->id;
            $status2 = '';
            $color = '';
            switch ($status) {
                case 1: case 2:
                    $color = 'success'; break;
                case 4: case 5:
                    $color = 'danger'; break;
                default:
                    $color = 'warning'; break;
            }
            if ($status == 3) {
                $status2 =
                '<a style="color: white;" class=" badge bg-'.$color.' for-update" data-id="'.$data->id.'">'
                    .$data->getStatus->name.
                '</a>';
            } else {
                $status2 =
                '<p style="color: white;" class=" badge bg-'.$color.' for-update">'
                    .$data->getStatus->name.
                '</p>';
            }
            return $status2;
        })
        ->addColumn('action', function ($data) {
            if ($data->status_id == 3) {
                return
                '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->id.'">
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>';
            }
        })
        ->rawColumns(['action'])
        ->escapeColumns([])
        ->make(true);
    }

    public function getAttachmentApproval($id_leave)
    {
        $data = Attachment::where('leave_id', $id_leave)->get();
        return DataTables::of($data)
        ->addColumn('id', function ($data) {
            return $data->id;
        })
        ->addColumn('name', function ($data) {
            return
            '<a href="../images/attachments/'.$data->name.'" target="_blank" rel="noopener noreferrer">'
                .$data->name.
            '</a>';
        })
        ->rawColumns(['name'])
        ->make(true);
    }
}
