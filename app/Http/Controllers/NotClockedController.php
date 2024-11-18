<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Attendance;
use App\Models\LeaveDetail;
use App\Models\Holiday;
use App\Models\Staff;
use App\Models\Department;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Datatables;

class NotClockedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function notClockedReport()
    {
        //$user = User::where('id', Auth::user()->id)->first();
        $department = Department::where('delete_department', 0)->get();
        $hodDepartment = Staff::where('user_id', Auth::user()->id)->first();
        $currentDate = date('Y-m-d');
        $currentYear = date('Y');
        $currentMonth = date('m');
        return view('notClockedReport.mainClockedReport',[
            'title' => 'Not Clocked Report',
            'title_menu' => 'Not Clocked Report',
            'department' => $department,
            'hodDepartment' => $hodDepartment,
            'currentYear' => $currentYear,
            'currentMonth' => $currentMonth,
            'currentDate' => $currentDate
        ]);
    }

    public function generateReport(Request $request)
    {
        $department = $request->input('departmentStaff');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($department == 0) {
            $departmentTitle = 'ALL DEPARTMENTS';

            $list = DB::select('SELECT u.name, dates.attendance_date
                FROM users u
                LEFT JOIN (
                SELECT DATE_ADD(?, INTERVAL t.n DAY) AS attendance_date
                FROM (
                    SELECT a.N + b.N * 10 AS n
                    FROM (
                    SELECT 0 AS N UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION
                    SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9
                    ) a
                    CROSS JOIN (
                    SELECT 0 AS N UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION
                    SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9
                    ) b
                ) t
                WHERE DATE_ADD(?, INTERVAL t.n DAY) BETWEEN ? AND ?
                    AND DAYOFWEEK(DATE_ADD(?, INTERVAL t.n DAY)) NOT IN (1,7)
                ) dates ON dates.attendance_date NOT IN (
                SELECT DATE_FORMAT(a.created_at, \'%Y-%m-%d\')
                FROM attendances a
                WHERE a.user_id = u.id
                )
                LEFT JOIN leavedetails ld ON u.id = ld.staff_id AND (ld.start_date <= dates.attendance_date AND ld.end_date >= dates.attendance_date)
                LEFT JOIN publicholidays ph ON dates.attendance_date BETWEEN ph.start_date AND ph.end_date
                WHERE u.id != 1 AND ld.staff_id IS NULL AND ph.id IS NULL
                ORDER BY dates.attendance_date ASC', [$startDate, $startDate, $startDate, $endDate, $startDate]);

        } else {
            //  $departmentTitle = Department::select('fullname')->where('id', $department)->first()->fullname.' DEPARTMENT';

             $departmentTitle = Department::select('fullname')
                ->where('id', $department)
                ->first()
                ->fullname.' DEPARTMENT';

                $list = DB::select('SELECT u.name, dates.attendance_date
                FROM users u
                JOIN staffs s ON u.id = s.user_id
                LEFT JOIN (
                SELECT DATE_ADD(?, INTERVAL t.n DAY) AS attendance_date
                FROM (
                    SELECT a.N + b.N * 10 AS n
                    FROM (
                    SELECT 0 AS N UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION
                    SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9
                    ) a
                    CROSS JOIN (
                    SELECT 0 AS N UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION
                    SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9
                    ) b
                ) t
                WHERE DATE_ADD(?, INTERVAL t.n DAY) BETWEEN ? AND ?
                    AND DAYOFWEEK(DATE_ADD(?, INTERVAL t.n DAY)) NOT IN (1,7)
                ) dates ON dates.attendance_date NOT IN (
                SELECT DATE_FORMAT(a.created_at, \'%Y-%m-%d\')
                FROM attendances a
                WHERE a.user_id = u.id
                )
                LEFT JOIN leavedetails ld ON u.id = ld.staff_id AND (ld.start_date <= dates.attendance_date AND ld.end_date >= dates.attendance_date)
                LEFT JOIN publicholidays ph ON dates.attendance_date BETWEEN ph.start_date AND ph.end_date
                WHERE s.department_id = ?
                    AND u.id != 1 
                    AND ld.staff_id IS NULL 
                    AND ph.id IS NULL
                ORDER BY dates.attendance_date ASC', [$startDate, $startDate, $startDate, $endDate, $startDate, $department]);
        }

        $list_arr = [];
            foreach($list as $l){
                $list_arr[$l ->attendance_date][] = [
                    'name' => $l->name ?? 'No Data'
                
                ];
            }
        $data = [
            'title' => 'VN HR List Not Clocked Report | ',
            'department' => $departmentTitle,
            'startDate' => $startDate,
            'endDate' =>$endDate,
            'list' => $list_arr
           
        ];
        return Pdf::loadView('notClockedReport.prints.notClockedReport', $data)->setPaper('a4', 'portrait')->stream();
    }
    
}
