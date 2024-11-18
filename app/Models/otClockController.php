<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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

    public function otViewClock(){
      $company = Company::all();
      $overtime = Overtime::all();
      $department = Department::all();
      $hod = Staff::where('user_id', Auth::user()->id)->first();
      $role = Role::all();
      $superior = RoleUser::whereIn('role_id', [1, 2, 3])->get();
      return view('overtime.otClock', [
          'title' => 'Over Time Clock In and Out',
          'title_menu' => 'Clock',
          'company' => $company,
          'department' => $department,
          'hod' => $hod,
          'role' => $role,
          'superior' => $superior
      ]);
    }

    public function otInsertClock(Request $request)
    {
      $validateData = $request->validate([
        'user_id' => 'required',
        'provePhoto' => 'required|image|mimes:png,jpg,jpeg|max:5048',
        'location_in' => 'nullable',
        'location_out' => 'nullable'
      ]);

      if($request->otClock == 0){

        $update = new Overtime;
        $update->location_in=$validateData['location_in'];
        $update->clockedTime_in=now();

      }else if ($request->otClock == 1) {

        $update = Overtime::orderBy('id','desc')->first();

        if($request->file('provePhoto')){
              $validateData['provePhoto'] = $request->file('provePhoto')->store('provePhoto');
        }

          $update->provePhoto=$validateData['provePhoto'];
          $update->location_out=$validateData['location_out'];
          $update->clockedTime_out=now();
        }

      $update->user_id=$validateData['user_id'];
      $update->save();

      return redirect()->route('overtime.index', [Auth::user()->id]);
    }
}
