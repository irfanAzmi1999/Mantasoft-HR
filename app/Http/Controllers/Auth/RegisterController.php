<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use App\Models\LeaveQuota;
use App\Models\Profile;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Staff;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5' /** 'confirmed' */],
            'username' => ['required', 'string', /**'max:255' */ 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->username = $data['username'];
        $user->delete_user = 0;
        $user->save();

        $role = new RoleUser();
        $role->user_id = $user->id;
        $role->role_id = $data['role_id'];
        $role->user_type = 'App\Models\User';
        $role->delete_roleuser = 0;
        $role->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $role->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $role->save();

        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->phone = $data['phone'];
        $profile->delete_profile = 0;
        $profile->save();

        $staff = new Staff();
        $staff->user_id = $user->id;
        $staff->department_id = $data['department_id'];
        $staff->company_id = $data['company_id'];
        $staff->superior_id = $data['superior_id'];
        $staff->employ_date = date('Y-m-d', strtotime($data['employ_date']));
        $staff->delete_staff = 0;
        $staff->save();

        $quota = new LeaveQuota();
        $quota->staff_id = $staff->id;
        $quota->year = Carbon::createFromFormat('Y-m-d', $staff->employ_date)->year;
        $quota->default = 14;
        $quota->taken = 0;
        $quota->balance = 14;
        $quota->mc_default = 14;
        $quota->mc_taken = 0;
        $quota->mc_balance = 14;
        $quota->maternity = 60;
        $quota->paternity = 3;
        $quota->delete_quota = 0;
        $quota->save();
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered(($user = $this->create($request->all()))));
        return response()->json([
            'success' => 1
        ]);

        // if ($validator->fails()) {    
        //     return response()->json($validator->messages(), 200);
        //   }
    }
}
