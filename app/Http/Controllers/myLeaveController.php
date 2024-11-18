<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveDetail;
use App\Models\Attachment;
use App\Models\EmergencyType;
use App\Models\LeaveType;
use App\Models\Staff;
use App\Models\Status;
use App\Models\User;
use Yajra\DataTables\DataTables;

class myLeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mainMyLeave($id){
        $model = Staff::where('id', $id)->get();
        return view('myLeave/mainMyLeave', [
            'title' => 'My Leave',
            'title_menu' => 'MyLeave',
            'staff_id' => $id,
            'id' => $id,
            'model' => $model
        ]);
    }

    public function editMyleave(Request $request) {
        $model = LeaveDetail::where('id', $request->input('id_leaveCont'))->first();
        $data = [];
        $data['staff_id'] = $model->staff_id;
        $data['leavetype_id'] = $model->getLeaveType->name;
        $data['status_id'] = $model->getStatus->name;
        // $data['status_id'] = $model->start_date;
        // $data['status_id'] = $model->end_date;
        $data['start_date'] = date('d-m-Y', strtotime($model->start_date));
        $data['end_date'] = date('d-m-Y', strtotime($model->end_date));
        $data['half_day'] = $model->half_day;
        $data['staff_remarks'] = $model->staff_remarks;

        return response()->json([
            'success' => 1,
            'data' => $data
            // 'leavetype_id' => $model->getLeaveType->name
        ]);
    }
        // public function createLeaveApp(Request $request){
    //     $insert = new LeaveDetail;
    //     $insert->staff_id=$request->input('staff_id');
    //     $insert->leavetype_id=$request->input('leavetype_id');
    //     $insert->emergencytype_id=$request->input('emergencytype_id');
    //     $insert->status_id=3;
    //     $insert->apply_date=\Carbon\Carbon::now()->toDateString();
    //     $insert->half_day=$request->input('half_day');
    //     $insert->start_date=date('Y-m-d', strtotime($request->input('start_date')));
    //     $insert->end_date=date('Y-m-d', strtotime($request->input('end_date')));
    //     $insert->date_leave=0;
    //     $insert->delete_leaveDetail=0;
    //     $insert->staff_remarks=$request->input('staff_remarks');
    //     $insert->save();
    //     return redirect('/leaveApplication');
    // }
    public function updateMyLeave(Request $request) {
        $update = LeaveDetail::where('id', $request->input('id_leaveCont'))->first();
        // $update->status_id = $request->input('status_id');
        // $update->start_date = $request->input('start_date');
        // $update->end_date = $request->input('end_date');
        $update->half_day = $request->input('half_day');
        $update->staff_remarks=$request->input('staff_remarks');
        switch($update->half_day) {
            case 0:
                $update->start_date = date('Y-m-d H:i:s', strtotime($request->input('start_date').'09:00:00'));
                $update->end_date = date('Y-m-d H:i:s', strtotime($request->input('end_date').'18:00:00'));
            case 1:
                $update->start_date = date('Y-m-d H:i:s', strtotime($request->input('start_date').'09:00:00'));
                $update->end_date = date('Y-m-d H:i:s', strtotime($request->input('end_date').'14:00:00'));
            case 2:
                $update->start_date = date('Y-m-d H:i:s', strtotime($request->input('start_date').'14:00:00'));
                $update->end_date = date('Y-m-d H:i:s', strtotime($request->input('end_date').'18:00:00'));
        };
        
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteMyLeave(Request $request) {
        $relations = LeaveDetail::where('id', $request->input('id_leaveCont'))->first();
        $relations->delete_leaveDetail = 1;
        $relations->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function getDeleteAtt(Request $request) {
        $model = Attachment::where('id', $request->input('id_AttCont'))->first();
        $data = [];
        $data['name'] = $model->name;
        $data['leave_id'] = $model->leave_id;
        return response()->json([
            'success' => 1,
            'data' => $data
            // 'leavetype_id' => $model->getLeaveType->name
        ]);
    }
    public function newAttachment(Request $request) {

        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        // die();
        $insert = new Attachment;
        if($request->input('picKuntul') > 0) {
            for($i = 0; $i < $request->input('picKuntul'); $i++) {
                // $leave = $upload[$i]->leave_id = $insert->id;
                $kuntulBanget = $request->file('attachments'.$i);
                $name = $kuntulBanget->getClientOriginalName();
                $type = $kuntulBanget->getMimeType();
                $size = $kuntulBanget->getSize();
                $kuntulBanget->get();
                // $delete = $upload[$i]->delete_attachment = 0;
                $path = 'images/attachments/';
                $kuntulBanget->move($path, $name);
                $attach = new Attachment;
                $attach->leave_id = $request->input('id_leaveCont');
                $attach->name = $name;
                $attach->type = $type;
                $attach->size = $size;
                $attach->delete_attachment = 0;
                $attach->save();
            } return response()->json([
                'success' => 1
            ]);
        }
    }

    public function softDeleteAttachment(Request $request) {
        $relations = Attachment::where('id', $request->input('id_AttCont'))->first();
        $relations->delete_attachment = 1;
        $relations->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function getMyLeave($id){
        $data = LeaveDetail::where('staff_id', $id)->where('delete_leaveDetail', 0)->get();
        return Datatables::of($data)
        ->addColumn('leavetype_id', function($data){
            $type = $data->getLeaveType->id;
            $color = '';
            if($type == 1){
                $color = 'success';
            }else if($type == 2){
                $color = 'dark';
            }else if($type == 3){
                $color = 'danger';
            }else if($type == 4){
                $color = 'dark';
            }else if($type == 5){
                $color = 'primary';
            }else if($type == 7){
                $color = 'primary';
            }else if($type == 9){
                $color = 'secondary';
            } else {
                $color = 'info';
            }
            return '
            <span class="badge bg-'.$color.' check" id="leave_type" data-id="'.$data->getLeaveType->id.'">'.$data->getLeaveType->name.'</span>
        ';
        })
        ->addColumn('start_date', function($data){
            return date('D d-M-Y', strtotime($data->start_date));
        })
        ->addColumn('end_date', function($data){
            return date('D d-M-Y', strtotime($data->end_date));
        })
        ->addColumn('date_leave', function($data){
            return round($data->date_leave);
        })
        ->addColumn('status_id', function($data){
            $datatype = $data->getStatus->id;
            $warna = '';
            if($datatype == 1 || $datatype == 2){
                $warna = 'success';
            } else if ($datatype == 3) {
                $warna = 'warning';
            } else if ($datatype == 4 ||  $datatype == 5){
                $warna = 'danger';
            } else {
                $warna = 'primary';
            } return'
            <span class="badge rounded-pill badge-glow bg-'.$warna.' status_leave" value="'.$datatype.'">'.$data->getStatus->name.'</span>
        ';
        })
        ->addColumn('action', function($data){
        $type = $data->status_id;
        $meor = '';
        if($type == 3) {
            $meor = '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->id.'">
                <i class="fa-regular fa-pen-to-square"></i>
            </button>
            <button class="btn btn-icon btn-danger for-delete" data-id="'.$data->id.'">
                <i class="fa-regular fa-trash-can"></i>
            </button>
            ';
        } else {
            $meor = '<button class="btn btn-icon btn-danger for-delete" data-id="'.$data->id.'">
            <i class="fa-regular fa-trash-can"></i>
        </button>';
        }
        return $meor;
    }) 
        ->rawColumns(['action','status_id','leavetype_id'])
        ->escapeColumns([])
        ->make(true);
    }

    public function getAttachment($id_leaveCont) {
        $data = Attachment::where('leave_id', $id_leaveCont)->where('delete_attachment', 0)->get();
        return DataTables::of($data)
        ->addColumn('leave_id', function($data){
            return $data->id;
        })
        ->addColumn('name', function($data){

            return '<a href="../images/attachments/'.$data->name.'" target="_blank" rel="noopener noreferrer">'.$data->name.'</a>';
        })
        ->addColumn('photo', function($data){

            return '<img class="h-60 w-75" src="../images/attachments/'.$data->name.'" loading="lazy">';
        })
        ->addColumn('action', function($data){
            return 
            '
            <button class="btn btn-icon btn-danger for-deleteAtt" data-id="'.$data->id.'">
                <i class="fa-regular fa-trash-can"></i>
            </button>
            ';
        })
        ->rawColumns(['action','name','photo'])
        ->make(true);
    }
}
