<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Segment\Api\Auth\ApiAuthController;

//STAFF MANAGEMENT CONTROLLERS
use App\Http\Controllers\EducationController;
use App\Http\Controllers\MarriageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePositionController;
use App\Http\Controllers\RelativesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;

//E-LEAVE CONTROLLERS
use App\Http\Controllers\LeaveAppController;
use App\Http\Controllers\LeaveApprovalController;
use App\Http\Controllers\LeaveDetailController;
use App\Http\Controllers\myLeaveController;
use App\Http\Controllers\LeaveSummaryController;
use App\Http\Controllers\LeaveUnpaidController;
use App\Http\Controllers\LeaveReportController;

//SETTINGS CONTROLLERS
use App\Http\Controllers\BloodController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmergencyTypeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\MaritalController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RelationsController;
use App\Http\Controllers\StatusController;

//ATTENDANCE
use App\Http\Controllers\AttendanceController;

use App\Http\Controllers\AttendanceReportController;

use App\Http\Controllers\otClockController;

//Clock
use App\Http\Controllers\ClockController;

//LOCATION
use App\Http\Controllers\LocationController;

//OVERTIME
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\OvertimeAppController;

//NOT CLOCKED REPORT
use App\Http\Controllers\NotClockedController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('', [Controller::class, 'landing']);
Route::get('home', [HomeController::class, 'index']);

//CLOCK
Route::get('clock/{type}', [ClockController::class, 'viewclock']);
Route::get('clock/{type}/{id}', [ClockController::class, 'viewclock']);
Route::post('clock',[ClockController::class,'insertclock'])-> name('clocks.insert');

//BLOOD
Route::get('readBlood', [BloodController::class, 'readBlood']);
Route::get('getBloods', [BloodController::class, 'getBloods']);
Route::post('createBlood', [BloodController::class, 'createBlood']);
Route::post('editBlood', [BloodController::class, 'editBlood']);
Route::post('updateBlood', [BloodController::class, 'updateBlood']);
Route::post('softDeleteBlood', [BloodController::class, 'softDeleteBlood']);

//CATEGORY
Route::get('readCategory', [CategoryController::class, 'readCategory']);
Route::get('getCategory', [CategoryController::class, 'getCategory']);
Route::post('createCategory', [CategoryController::class, 'createCategory']);
Route::post('editCategory', [CategoryController::class, 'editCategory']);
Route::post('updateCategory', [CategoryController::class, 'updateCategory']);
Route::post('softDeleteCategory', [CategoryController::class, 'softDeleteCategory']);

//COMPANY
Route::get('readCompany', [CompanyController::class, 'readCompany']);
Route::get('getCompany', [CompanyController::class, 'getCompany']);
Route::post('createCompany', [CompanyController::class, 'createCompany']);
Route::post('editCompany', [CompanyController::class, 'editCompany']);
Route::post('updateCompany', [CompanyController::class, 'updateCompany']);
Route::post('softDeleteCompany', [CompanyController::class, 'softDeleteCompany']);

//DEPARTMENT
Route::get('readDepartment', [DepartmentController::class, 'readDepartment']);
Route::get('getDepartment', [DepartmentController::class, 'getDepartment']);
Route::post('createDepartment', [DepartmentController::class, 'createDepartment']);
Route::post('editDepartment', [DepartmentController::class, 'editDepartment']);
Route::post('updateDepartment', [DepartmentController::class, 'updateDepartment']);
Route::post('softDeleteDep', [DepartmentController::class, 'softDeleteDepartment']);

//EDUCATION
Route::get('readEducation/{id}', [EducationController::class, 'readEducation']);
Route::get('getEducations/{id}', [EducationController::class, 'getEducations']);
Route::post('createEducation', [EducationController::class, 'createEducation']);
Route::post('editEducation', [EducationController::class, 'editEducation']);
Route::post('updateEducation', [EducationController::class, 'updateEducation']);
Route::post('softDeleteEducation', [EducationController::class, 'softDeleteEducation']);

//EMERGENCY TYPE
Route::get('readEmergencyType', [EmergencyTypeController::class, 'readEmergencyType']);
Route::get('getEmergencyType', [EmergencyTypeController::class, 'getEmergencyType']);
Route::post('createEmergencyType', [EmergencyTypeController::class, 'createEmergencyType']);
Route::post('editEmergencyType', [EmergencyTypeController::class, 'editEmergencyType']);
Route::post('updateEmergencyType', [EmergencyTypeController::class, 'updateEmergencyType']);
Route::post('softDeleteEmergencyType', [EmergencyTypeController::class, 'softDeleteEmer']);

//LEAVE TYPE
Route::get('readLeaveType', [LeaveTypeController::class, 'readLeaveType']);
Route::get('getLeaveType', [LeaveTypeController::class, 'getLeave']);
Route::post('createLeaveType', [LeaveTypeController::class, 'createLeaveType']);
Route::post('editLeaveType', [LeaveTypeController::class, 'editLeaveType']);
Route::post('updateLeaveType', [LeaveTypeController::class, 'updateLeaveType']);
Route::post('softDeleteLeaveType', [LeaveTypeController::class, 'softDeleteLeaveType']);

//MARITAL
Route::get('readMarital', [MaritalController::class, 'readMarital']);
Route::get('getMaritals', [MaritalController::class, 'getMarital']);
Route::post('createMarital', [MaritalController::class, 'createMarital']);
Route::post('editMarital', [MaritalController::class, 'editMarital']);
Route::post('updateMarital', [MaritalController::class, 'updateMarital']);
Route::post('softDeleteMar', [MaritalController::class, 'softDeleteMar']);

//MARRIAGE
Route::get('readMarriage/{id}', [MarriageController::class, 'readMarriage']);
Route::get('getMarriage/{id}', [MarriageController::class, 'getMarriage']);
Route::post('createMarriage', [MarriageController::class, 'createMarriage']);
Route::post('editMarriage', [MarriageController::class, 'editMarriage']);
Route::post('updateMarriage', [MarriageController::class, 'updateMarriage']);
Route::post('softDeleteMarriage', [MarriageController::class, 'softDeleteMarriage']);

//NATIONALITY
Route::get('readNationality', [NationalityController::class, 'readNationality']);
Route::get('getNationality', [NationalityController::class, 'get_national']);
Route::post('createNationality', [NationalityController::class, 'createNationality']);
Route::post('editNationality', [NationalityController::class, 'editNationality']);
Route::post('updateNationality', [NationalityController::class, 'updateNationality']);
Route::post('softDeleteNat', [NationalityController::class, 'softDeleteNat']);

//POSITION
Route::get('readPosition', [PositionController::class, 'readPosition']);
Route::get('getPositions', [PositionController::class, 'getPosition']);
Route::post('createPosition', [PositionController::class, 'createPosition']);
Route::post('editPosition', [PositionController::class, 'editPosition']);
Route::post('updatePosition', [PositionController::class, 'updatePosition']);
Route::post('softDeletePosition', [PositionController::class, 'softDeletePos']);

//PROFILE
Route::get('readProfile', [ProfileController::class, 'readProfile']);
Route::get('newProfile', [ProfileController::class, 'newProfile']);
Route::post('createProfile', [ProfileController::class, 'createProfile']);
Route::get('editProfile/{id}', [ProfileController::class, 'editProfile']);
Route::post('editProfileModal', [ProfileController::class, 'editProfileModal']);
Route::post('updateProfile', [ProfileController::class, 'updateProfile']);
Route::post('updateModalProfile', [ProfileController::class, 'updateModalProfile']);
Route::post('updateallProfile', [ProfileController::class, 'updateallProfile']);

//PROFILE POSITION
Route::get('readProfilePosition/{id}', [ProfilePositionController::class, 'readProfilePosition']);
Route::get('getProfilePositions/{id}', [ProfilePositionController::class, 'getProfilePositions']);
Route::post('createProfilePosition', [ProfilePositionController::class, 'createProfilePosition']);
Route::post('editProfilePosition', [ProfilePositionController::class, 'editProfilePosition']);
Route::post('updateProfilePosition', [ProfilePositionController::class, 'updateProfilePosition']);
Route::post('softDeleteProPos', [ProfilePositionController::class, 'softDeleteProPos']);

//PUBLIC HOLIDAY
Route::get('readHoliday', [HolidayController::class, 'readHoliday']);
Route::get('getHolidays', [HolidayController::class, 'getHoliday']);
Route::post('createHoliday', [HolidayController::class, 'createHoliday']);
Route::post('editHoliday', [HolidayController::class, 'editHoliday']);
Route::post('updateHoliday', [HolidayController::class, 'updateHoliday']);
Route::post('softDeleteHoliday', [HolidayController::class, 'softDeleteHol']);

//RELATION
Route::get('mainRelations', [RelationsController::class, 'read']);
Route::get('get-relation', [RelationsController::class, 'get_relation']);
Route::post('createRelation', [RelationsController::class, 'createRelation']);
Route::post('updateRelations', [RelationsController::class, 'updateRelations']);
Route::post('updateRelationData', [RelationsController::class, 'updateRelationData']);
Route::post('softDelete', [RelationsController::class, 'softDelete']);

//RELATIVE
Route::get('mainRelatives/{id}', [RelativesController::class, 'readRelatives']);
Route::get('getRelatives/{id}', [RelativesController::class, 'getRelatives']);
Route::post('createRelatives', [RelativesController::class, 'createRelatives']);
Route::post('editRelatives', [RelativesController::class, 'editRelatives']);
Route::post('updateRelatives', [RelativesController::class, 'updateDataRelatives']);
Route::post('softDeleteRel', [RelativesController::class, 'softDeleteRel']);

//STATUS
Route::get('readStatus', [StatusController::class, 'readStatus']);
Route::get('getStatus', [StatusController::class, 'getStatus']);
Route::post('createStatus', [StatusController::class, 'createStatus']);
Route::post('editStatus', [StatusController::class, 'editStatus']);
Route::post('updateStatus', [StatusController::class, 'updateStatus']);
Route::post('softDeleteStatus', [StatusController::class, 'softDeleteStatus']);

//USER
Route::get('listAllUser', [UserController::class, 'listAllUser']);
Route::get('getAllUser', [UserController::class, 'getAllUser']);
Route::get('getUserUnderHod', [UserController::class, 'getUserUnderHod']);
Route::get('softDeleteUser/{id}', [UserController::class, 'softDeleteUser']);

//LEAVE APPLICATION
Route::get('/leaveApplication', [LeaveAppController::class, 'mainLeaveApp']);
Route::post('/createLeaveApp', [LeaveAppController::class, 'createLeaveApp']);

//MY LEAVE
Route::get('/MyLeave/{id}', [myLeaveController::class, 'mainMyLeave']);
Route::get('/getMyLeave/{id}', [myLeaveController::class, 'getMyLeave']);
Route::post('/editMyLeave', [myLeaveController::class, 'editMyleave']);
Route::post('/updateMyLeave', [myLeaveController::class, 'updateMyLeave']);
Route::post('/softDeleteMyLeave', [myLeaveController::class, 'softDeleteMyLeave']);
Route::get('/getAttachment/{id_leaveCont}', [myLeaveController::class, 'getAttachment']);
Route::post('/getDeleteAtt', [myLeaveController::class, 'getDeleteAtt']);
Route::post('/softDeleteAtt', [myLeaveController::class, 'softDeleteAttachment']);
Route::post('/newAttachment', [myLeaveController::class, 'newAttachment']);

//LEAVE DETAIL
Route::get('readLeaveDetails', [LeaveDetailController::class, 'readLeaveDetails']);
Route::get('getLeaveDetails', [LeaveDetailController::class, 'getLeaveDetails']);
Route::get('getLeaveDetailsForHod', [LeaveDetailController::class, 'getLeaveDetailsForHod']);
Route::post('openLeaveDetail', [LeaveDetailController::class, 'openLeaveDetail']);
Route::get('getLeaveDetail/{id_staff}', [LeaveDetailController::class, 'getLeaveDetail']);

//LEAVE APPROVAL
Route::get('leaveApproval', [LeaveApprovalController::class, 'readAllLeave']);
Route::get('getAllLeave', [LeaveApprovalController::class, 'getAllLeave']);
Route::get('getLeaveForHod', [LeaveApprovalController::class, 'getLeaveForHod']);
Route::post('openApproval', [LeaveApprovalController::class, 'openApproval']);
Route::post('leaveApproval', [LeaveApprovalController::class, 'leaveApproval']);
Route::get('getAttachmentApproval/{id_leave}', [LeaveApprovalController::class, 'getAttachmentApproval']);

//LEAVE SUMMARY
Route::get('leaveSummary', [LeaveSummaryController::class, 'readAllSummary']);
Route::get('getAllSummary', [LeaveSummaryController::class, 'getAllSummary']);
Route::post('openSummary', [LeaveSummaryController::class, 'openSummary']);

//LEAVE UNPAID
Route::get('leaveUnpaid', [LeaveUnpaidController::class, 'readAllUnpaid']);
Route::get('getAllUnpaid', [LeaveUnpaidController::class, 'getAllUnpaid']);
Route::post('openUnpaid', [LeaveUnpaidController::class, 'openUnpaid']);

//LEAVE REPORT
Route::get('leaveReport', [LeaveReportController::class, 'leaveReport']);
Route::post('printStaff', [LeaveReportController::class, 'generateStaff']);
Route::post('printLeave', [LeaveReportController::class, 'generateLeave']);

//ATTENDANCE
Route::get('/listAttendance/{id}', [AttendanceController::class, 'listOfAttendance'])->name('attendance.index');
Route::get('/getCurrentAttendance/{id}', [AttendanceController::class, 'getCurrentAttendance']);

// ATTENDANCE REPORT
Route::get('attendanceReport', [AttendanceReportController::class, 'attendanceReport']);
Route::post('printAttendance', [AttendanceReportController::class, 'generateAttendance']);

//OTCLOCK
Route::get('otClock/{type}', [otClockController::class, 'otViewClock']);
Route::get('otClock/{type}/{id}', [otClockController::class, 'otViewClock']);
Route::post('otClock',[otClockController::class,'otInsertClock'])-> name('otClocks.insert');

//OVERTIME
Route::get('/listOvertime/{id}', [OvertimeController::class, 'listOvertime'])->name('overtime.index');
Route::get('/getOvertime/{id}', [OvertimeController::class, 'getOvertime']);


//ATTENDANCE
Route::get('/listAttendance/{id}', [AttendanceController::class, 'listOfAttendance'])->name('attendance.index');
Route::get('/getCurrentAttendance/{id}', [AttendanceController::class, 'getCurrentAttendance']);

//ATTENDANCE REPORT
Route::get('attendanceReport', [AttendanceReportController::class, 'attendanceReport']);
Route::post('printAttendance', [AttendanceReportController::class, 'generateAttendance']);

//OVERTIME
Route::get('/listOvertime/{id}', [OvertimeController::class, 'listOvertime'])->name('overtime.index');
Route::get('/getOvertime/{id}', [OvertimeController::class, 'getOvertime']);


//ATTENDANCE
Route::get('/listAttendance/{id}', [AttendanceController::class, 'listOfAttendance'])->name('attendance.index');
Route::get('/getCurrentAttendance/{id}', [AttendanceController::class, 'getCurrentAttendance']);

//ATTENDANCE REPORT
Route::get('attendanceReport', [AttendanceReportController::class, 'attendanceReport']);
Route::post('printAttendance', [AttendanceReportController::class, 'generateAttendance']);

//OVERTIME
Route::get('/listOvertime/{id}', [OvertimeController::class, 'listOvertime'])->name('overtime.index');
Route::get('/getOvertime/{id}', [OvertimeController::class, 'getOvertime']);

//OVERTIME APPLICATION
Route::get('/overtimeApplication', [OvertimeAppController::class, 'mainOvertimeApp']);
Route::post('/createOvertimeApp', [OvertimeAppController::class, 'createOvertimeApp']);

//NOT CLOCKED REPORT
Route::get('/notClockedReport', [NotClockedController::class, 'notClockedReport']);
Route::post('/notClockedReport', [NotClockedController::class, 'notClockedReport']);
Route::post('/printnotClockedReport', [NotClockedController::class, 'generateReport']);

Route::prefix('/user')->group(function () {
    Route::get('/get-token', [ApiAuthController::class, 'getToken']);
    Route::post('/get-user', [ApiAuthController::class, 'getUser']);
    Route::post('/delete-user', [ApiAuthController::class, 'deleteToken']);
    Route::post('/save-attendance', [ApiAuthController::class, 'saveAttendance']);
    Route::post('/history-attendance', [ApiAuthController::class, 'historyAttendance']);
});