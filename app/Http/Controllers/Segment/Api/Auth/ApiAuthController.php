<?php
namespace App\Http\Controllers\Segment\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Str;

class ApiAuthController extends Controller{

    public function getToken(Request $request){
        $response = [
            'status' => null,
            'token' => null,
        ];

        $status = 200;

        $user_c = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        $user = User::where('username', $user_c['username'])->first();
        if (! $user || ! Hash::check($user_c['password'], $user->password)) {
            $response['status'] = 0;
            $status = 500;
        }else{
            $response['status'] = 1;
            $response['token'] = $user->createToken('regularUser')->plainTextToken;
        }

        return response()->json($response, $status);
    }

    public function getUser(Request $request){
        $user = auth('sanctum')->user();
        return response()->json($user, $user ? 200 : 500);
    }

    public function deleteToken(Request $request){
        auth('sanctum')->user()->tokens()->delete();
    }



    public function saveAttendance(Request $request){
        $user = auth('sanctum')->user();
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $address = $request->input('address');
        $clockType = $request->input('clock_type');
        $photo = $request->input('pic');
        $reasonOut = $request->input('reason_out');
    
        if($photo){
            $image = base64_decode($photo);
            $imagename = Str::random(10).'.png';
            file_put_contents(public_path('/api/attendance'.'/'.$imagename), $image);
        }
    
        $cur_time = date("H:i:s");
    
        $late = 0;
        if($cur_time >= strtotime('08:30:00')){
            $late = 1;
        }
    
        // Check if there is an existing record for the user on the current date
        $existingAttendance = Attendance::where('user_id', $user->id)
        ->where('curentDate', date('Y-m-d'))
        ->latest('created_at')
        ->first();
    
        if($clockType == 1) {
            // Update the existing record for clocking out
            $existingAttendance->location_out = $address;
            $existingAttendance->time_out = $cur_time;
            $existingAttendance->latitude_out = $latitude;
            $existingAttendance->longitude_out = $longitude;
            $existingAttendance->photo_out = $imagename;
            $existingAttendance->reason_out = $reasonOut;

            if($existingAttendance->save()){
                return response()->json([
                    'status' => 1,
                    'late' => $late,
                    'time' => $cur_time
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'late' => $late,
                ]);
            }
        } else {
            // Create a new record for clocking in
            $model = new Attendance;
            $model->user_id = $user->id;
            $model->curentDate = date("Y-m-d");
            $model->location_in = $address;
            $model->time_in = $cur_time;
            $model->latitude_in = $latitude;
            $model->longitude_in = $longitude;
            $model->photo_in = $imagename;
            $model->late_status = $late;
            $model->reason_out = $reasonOut;

            if($model->save()){
                return response()->json([
                    'status' => 1,
                    'late' => $late,
                    'time' => $cur_time
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'late' => $late,
                ]);
            }
        }
    }
    

    public function historyAttendance(Request $request){
        $user = auth('sanctum')->user();
        $date =  date('Y-m-d', strtotime($request->input('date')));

        $data = [];

        $model = Attendance::where('user_id', $user->id)->whereDate('created_at', $date)->get()->toArray();

        if($model){
            $data = $model;
        }


        return response()->json([
            'data' => $data
        ]);
    }
}
