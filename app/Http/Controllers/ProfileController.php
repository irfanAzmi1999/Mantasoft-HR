<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Blood;
use App\Models\Nationality;
use App\Models\User;
use App\Models\Staff;
use App\Models\Department;
use App\Models\ProfilePosition;
use App\Models\RoleUser;
use App\Models\Role;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function readProfile() {
        $model = Profile::where('user_id', Auth::user()->id)->get();
        $blood = Blood::all();
        $Department = Department::all();
        $nationality = Nationality::all();
        $staff = Staff::where('user_id', Auth::user()->id)->first();
        return view('profiles.viewprofile', [
            'title' => 'Profile',
            'title_menu' => 'Profile',
            'model' => $model,
            'blood' => $blood,
            'Department' => $Department,
            'nationality' => $nationality,
            'staff' => $staff
        ]);
    }

    public function updateProfile(Request $request) {
        $user = User::where('id', $request->input('user_id'))->first();
        $user->name = $request->input('name_user');
        $user->email = $request->input('email_user');
        $user->username = $request->input('username_user');
        $user->save();
        $update = Profile::where('id', $request->input('id'))->first();
        $update->blood_id = $request->input('blood_id');
        $update->nationality_id = $request->input('nationality_id');
        $update->phone = $request->input('phone');
        $update->address = $request->input('address');
        if($request->input('dob') != null) {
            $update->dob = date('Y-m-d', strtotime($request->input('dob')));
        } else {
            $update->dob = null;
        }
        $update->pob = $request->input('pob');
        $update->gender = $request->input('gender');
        $update->height = $request->input('height');
        $update->weight = $request->input('weight');
        $update->nokp_new = $request->input('nokp_new');
        $update->nokp_old = $request->input('nokp_old');
        $update->epf = $request->input('epf');
        $update->tax = $request->input('tax');
        if ($upload = $request->file('image')) {
            $path = 'images/profiles/';
            $image = $upload->getClientOriginalName();
            $upload->move($path, $image);
            $update->image = $image;
        } else {
            unset($image);
        }
        $update->save();
        return redirect('/readProfile');
    }

    public function editProfile($id) {
        $model = Profile::where('id', $id)->get();
        $blood = Blood::all();
        $Department = Department::all();
        $nationality = Nationality::all();
        $role = Role::all();
        $RoleUser = RoleUser::where('user_id', $id)->get();
        $staff = Staff::where('user_id', $id)->get();
        $superior = RoleUser::whereIn('role_id', [1, 2, 3])->get();
        return view('profiles.formupdateprofile', [
            'title' => 'Edit Profile',
            'title_menu' => 'Profile',
            'model' => $model,
            'blood' => $blood,
            'Department' => $Department,
            'nationality' => $nationality,
            'role' => $role,
            'RoleUser' => $RoleUser,
            'staff' => $staff,
            'superior' => $superior
        ]);
    }

    public function updateallProfile(Request $request) {
        $user = User::where('id', $request->input('user_id'))->first();
        $user->name = $request->input('name_user');
        $user->email = $request->input('email_user');
        $user->username = $request->input('username_user');
        $user->save();
        $update = Profile::where('id', $request->input('id'))->first();
        $update->blood_id = $request->input('blood_id');
        $update->nationality_id = $request->input('nationality_id');
        $update->phone = $request->input('phone');
        $update->address = $request->input('address');
        if($request->input('dob') != null) {
            $update->dob = date('Y-m-d', strtotime($request->input('dob')));
        } else {
            $update->dob = null;
        }
        $update->pob = $request->input('pob');
        $update->gender = $request->input('gender');
        $update->height = $request->input('height');
        $update->weight = $request->input('weight');
        $update->nokp_new = $request->input('nokp_new');
        $update->nokp_old = $request->input('nokp_old');
        $update->epf = $request->input('epf');
        $update->tax = $request->input('tax');
        if ($upload = $request->file('image')) {
            $path = 'images/profiles/';
            $image = $upload->getClientOriginalName();
            $upload->move($path, $image);
            $update->image = $image;
        } else {
            unset($image);
        }
        $update->save();
        $RoleUser = RoleUser::where('user_id', $user->id)->first();
        $RoleUser->role_id = $request->input('role_id');
        $RoleUser->save();
        $staff = Staff::where('user_id', $user->id)->first();
        $staff->department_id = $request->input('department_id');
        $staff->superior_id = $request->input('superior_id');
        $staff->employ_date = date('Y-m-d', strtotime($request->input('employ_date')));
        $staff->save();
        return redirect('editProfile/'.$update->id);
    }

    public function editProfileModal(Request $request) {
        $model = Profile::where('id', $request->input('id_profileCont'))->first();
        $blood = Blood::all();
        $nationality = Nationality::all();
        $Department = Department::all();
        $superior = RoleUser::whereIn('role_id', [1, 2, 3])->get();
        $staff = Staff::where('user_id',  $request->input('id_taffcont'))->get();
        $role = Role::all();
        return response()->json([
            'success' => 1,
            'phone' => $model->phone,
            'user_name' => $model->getUser->name,
            'user_username' => $model->getUser->username,
            'email' => $model->getUser->email
        ]);
    }
	
	public function updateModalProfile(Request $request){
        $update = Profile::where('id', $request->input('id_profileCont'))->first();
        $update->phone = $request->input('phone');
        $update->save();
        $user = User::find($update->user_id);
        $user->name = $request->input('name_user');
        $user->email = $request->input('email_user');
        $user->username = $request->input('username_user');
        $user->save();
        return response()->json([
            'success' => 1
        ]);
    }
}
