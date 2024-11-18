<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Overtime;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;
use Url;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function listOfAttendance($id)
    {
        $model = User::where('id',$id)->get();
        return view('attendances/listTracker',[
            'title' => 'List Attendance',
            'title_menu' => 'Attendance',
            'user_id' => $id,
            'id' => $id
        ]);
    }

    public function getCurrentAttendance($id){   
            $data = Attendance::where('user_id', $id)->get();
            return DataTables::of($data)

            ->addColumn('currentDate', function($data){
                return date('d-M-Y', strtotime($data->curentDate));
            })
            ->addColumn('time_in', function($data){
                return $data->time_in??'No Data';
            })
            ->addColumn('location_in', function($data){
                return $data->location_in??'No Data';
            })
            ->addColumn('photo_in', function($data){
                return '<a href="../pictures/'.$data->photo_in.'" target="_blank" rel="noopener noreferrer"><img class="h-60 w-75" src="../pictures/'.$data->photo_in.'" loading="lazy"></a>';
                
                ///return '<img class="h-60 w-75" src="../pictures/'.$data->photo_in.'" loading="lazy">';
            })
            ->addColumn('time_out', function($data){
                return $data->time_out??'No Data';
            })
            ->addColumn('location_out', function($data){
                return $data->location_out??'No Data';
            })
            ->addColumn('photo_out', function($data){
                if (!empty($data->photo_out)) {
                    return '<a href="../pictures/'.$data->photo_out.'" target="_blank" rel="noopener noreferrer"><img class="h-60 w-75" src="../pictures/'.$data->photo_out.'" loading="lazy"></a>';
                } else {
                    return 'No Photo';
                }
            })
            
            ->addColumn('clock_out', function($data){
                $btn = '<a href='.Url('/').'/clock/1/'.$data->id.'><button class="btn btn-icon btn-danger for-clockOut">
                    <i class="fa fa-sign-out"></i>
                    </button></a>';
                return $btn;
            })
            ->rawColumns(['clock_out'])
            ->escapeColumns([])
            ->make(true);
            
        }

   }
