<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use App\Models\Role;
use App\Models\Staff;
use App\Models\RoleUser;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class ClockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewClock($type, $id = false){

      // print_r($request->all());
      // die();
      $company = Company::all();
      $attendance = Attendance::all();
      $department = Department::all();
      $hod = Staff::where('user_id', Auth::user()->id)->first();
      $role = Role::all();
      $superior = RoleUser::whereIn('role_id', [1, 2, 3])->get();
      return view('attendances.clock', [
          'title' => $type == 0 ? 'Clock In' : 'Clock Out',
          'title_menu' => $type == 0 ? 'Clock In' : 'Clock Out',
          'company' => $company,
          'department' => $department,
          'hod' => $hod,
          'role' => $role,
          'superior' => $superior,
          'type' => $type,
          'id' => $id ? $id : null
      ]);
    }

    public function insertClock(Request $request)
    {
      $validateData = $request->validate([
        'user_id' => 'required',
        'photo_in' => 'required|image|mimes:png,jpg,jpeg|max:5048',
        'reasonLate_in' => 'nullable',
        'location_in' => 'nullable'
      ]);

      if($request->clock == 0){

        $update = new Attendance;
        $update->location_in=$validateData['location_in'];
        $update->reasonLate_in=$validateData['reasonLate_in'];
        $update->time_in=now();
        $update->curentDate = date('Y-m-d');

         $image = $request->file('photo_in');
         $destinationPath = public_path(). '/pictures';
         $filename = Str::random(10).'.jpg';

        if($request->file('photo_in')){
              $image->move($destinationPath, $filename);
              $update->photo_in = $filename;
        }

      }else if ($request->clock == 1) {
        // $update = Attendance::orderBy('id','desc')->first();
        $update = Attendance::where('id', $request->input('attendance_id'))->first();
        $update->location_out=$validateData['location_in'];
        $update->reason_out=$validateData['reasonLate_in'];
        $update->time_out=now();

        $image = $request->file('photo_in');
        $destinationPath = public_path(). '/pictures';
        $filename = Str::random(10).'.jpg';

        if($request->file('photo_in')){

          $image->move($destinationPath, $filename);
              $update->photo_out = $filename;
        }

      }
      $update->user_id=$validateData['user_id'];
      $update->save();

    return redirect()->route('attendance.index', [Auth::user()->id]);
    }
}
