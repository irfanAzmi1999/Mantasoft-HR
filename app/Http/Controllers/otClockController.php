<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Overtime;
use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use App\Models\Role;
use App\Models\Staff;
use App\Models\RoleUser;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class otClockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function otViewClock($type, $id = false){
      $company = Company::all();
      $overtime = Overtime::all();
      $department = Department::all();
      $hod = Staff::where('user_id', Auth::user()->id)->first();
      $role = Role::all();
      $superior = RoleUser::whereIn('role_id', [1, 2, 3])->get();
      return view('overtime.otClock', [
          'title' => $type == 0 ? 'Overtime Clock In' : 'Overtime Clock Out',
          'title_menu' =>$type == 0 ? 'Overtime Clock In' : 'Overtime Clock Out',
          'company' => $company,
          'department' => $department,
          'hod' => $hod,
          'role' => $role,
          'superior' => $superior,
          'type' => $type,
          'id' => $id ? $id : null
      ]);
    }

    public function otInsertClock(Request $request)
    {

      if($request->otClock == 0){

        $validateData = $request->validate([
          'location_in' => 'nullable',
          'location_out' => 'nullable',
          'user_id' => 'required',
        ]);

        $update = new Overtime;
        $update->location_in=$validateData['location_in'];
        $update->clockedTime_in=now();
        $update->curentDate = date('Y-m-d');

      }else if ($request->otClock == 1) {

        $validateData = $request->validate([
          'location_in' => 'nullable',
          'location_out' => 'nullable',
          'user_id' => 'required',
          'provePhoto' => 'required|image|mimes:png,jpg,jpeg|max:5048'
        ]);

        $update = Overtime::where('id', $request->input('attendance_id'))->first();
          $update->location_out=$validateData['location_in'];
          $update->clockedTime_out=now();

        $image = $request->file('provePhoto');
        $destinationPath = public_path(). '/pictures';
        $filename = Str::random(10).'.jpg';

        if($request->file('provePhoto')){
              $image ->move($destinationPath, $filename);
              $update->provePhoto = $filename;
        }
      }
      $update->user_id=$validateData['user_id'];
      $update->save();

      return redirect()->route('overtime.index', [Auth::user()->id]);
    }
}
