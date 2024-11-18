<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveDetail;
use App\Models\Attachment;
use App\Models\Overtime;
use App\Models\OvertimeApplication;
use App\Models\Staff;
use App\Models\Status;
use App\Models\User;
use Yajra\DataTables\DataTables;

class overtimeAppListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function overtimeAppList($id){
        $model = Staff::where('id', $id)->get();
        return view('overtimeApplication/overtimeAppList', [
            'title' => 'My Overtime Application List And Status',
            'title_menu' => 'Overtime Application List',
            'staff_id' => $id,
            'id' => $id,
            'model' => $model
        ]);
    }

    public function editMyovertimeApp(Request $request) {
        $model = OvertimeApplication::where('id', $request->input('id_leaveCont'))->first();
        $data = [];
        $data['staff_id'] = $model->staff_id;
        $data['status_id'] = $model->getStatus->name;
        $data['time_in'] = date('d-m-Y', strtotime($model->time_in));
        $data['time_out'] = date('d-m-Y', strtotime($model->time_out));

        return response()->json([
            'success' => 1,
            'data' => $data;
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

    public function getOvertimeList($id){
        $data = OvertimeApplication::where('user_id', $id)->get();
        return Datatables::of($data)

        ->addColumn('date', function($data){
            return date('D d-M-Y', strtotime($data->date));
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
}
