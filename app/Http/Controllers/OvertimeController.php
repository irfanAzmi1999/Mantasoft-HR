<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Overtime;
use App\Models\Attendance;
use App\Models\User;
use App\Models\OvertimeApplication;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listOvertime($id)
    {
        $model = User::where('id',$id)->get();
        //dd($model);
        return view('overtime/overtimeList',[
            'title' => 'List Of Overtime',
            'title_menu' => 'Attendance',
            'user_id' => $id,
            'id' => $id
        ]);
    }

    public function getOvertime($id){   
        $data = Overtime::where('user_id', $id)->get();

        return DataTables::of($data)
        ->addColumn('date', function($data){
            return date('D, d M Y', strtotime($data->date));
        })
        ->addColumn('clockedTime_in', function($data){
            return $data->clockedTime_in;
        })
        ->addColumn('clockedTime_out', function($data){
            return $data->clockedTime_out;
        })
        ->addColumn('location_in', function($data){
            return $data->location_in;
        })
        ->addColumn('location_out', function($data){
            return $data->location_out;
        })
        ->addColumn('clockOut', function($data){
            $btn = '<a href='.Url('/').'/otClock/1/'.$data->id.'><button class="btn btn-icon btn-danger for-clockOut">
                    <i class="fa fa-sign-out"></i>
                    </button></a>';
                return $btn;
        })
        ->rawColumns(['clockOut'])
        ->escapeColumns([])
        ->make(true);
    }
}
