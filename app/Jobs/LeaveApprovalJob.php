<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeaveApproveMail;
use App\Mail\LeaveNotifyMail;
use App\Mail\LeaveRejectMail;

class LeaveApprovalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $staff, $superior, $trigger, $leave;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($staff, $superior, $trigger, $leave)
    {
        $this->staff = $staff;
        $this->superior = $superior;
        $this->trigger = $trigger;
        $this->leave = $leave;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(in_array($this->trigger, [1,2])){
            $approved = [
                'title' => $this->leave->getStaff->getUser->name,
                'leaveType' => $this->leave->getLeaveType->name,
                'status' => $this->leave->getStatus->name,
                'approver_remarks' => $this->leave->approver_remarks,
                'start_date' => date('D, d M Y', strtotime($this->leave->start_date)),
                'end_date' => date('D, d M Y', strtotime($this->leave->end_date)),
                'date_leave' => str_contains($this->leave->date_leave, '.0') ? str_replace('.0', '', $this->leave->date_leave) : $this->leave->date_leave,
                'apply_date' => date('D, d M Y', strtotime($this->leave->apply_date)),
            ];
            $notify = [
                'superior' => $this->leave->getStaff->getSuperior->name,
                'nameStaff' => $this->leave->getStaff->getUser->name,
                'leaveType' => $this->leave->getLeaveType->name,
                'status' => $this->leave->getStatus->name,
                'approver_remarks' => $this->leave->approver_remarks,
                'start_date' => date('D, d M Y', strtotime($this->leave->start_date)),
                'end_date' => date('D, d M Y', strtotime($this->leave->end_date)),
                'date_leave' => str_contains($this->leave->date_leave, '.0') ? str_replace('.0', '', $this->leave->date_leave) : $this->leave->date_leave,
                'apply_date' => date('D, d M Y', strtotime($this->leave->apply_date)),
            ];
            Mail::to($this->staff)->send(new LeaveApproveMail($approved));
        } else if (in_array($this->trigger, [4,5])) {
            $rejected = [
                'title' => $this->leave->getStaff->getUser->name,
                'leaveType' => $this->leave->getLeaveType->name,
                'status' => $this->leave->getStatus->name,
                'approver_remarks' => $this->leave->approver_remarks,
                'start_date' => date('D, d M Y', strtotime($this->leave->start_date)),
                'end_date' => date('D, d M Y', strtotime($this->leave->end_date)),
                'date_leave' => str_contains($this->leave->date_leave, '.0') ? str_replace('.0', '', $this->leave->date_leave) : $this->leave->date_leave,
                'apply_date' => date('d M Y', strtotime($this->leave->apply_date)),
                'superior' => $this->leave->getStaff->getSuperior->name,
            ];
            $notify = [
                'superior' => $this->leave->getStaff->getSuperior->name,
                'nameStaff' => $this->leave->getStaff->getUser->name,
                'leaveType' => $this->leave->getLeaveType->name,
                'status' => $this->leave->getStatus->name,
                'approver_remarks' => $this->leave->approver_remarks,
                'start_date' => date('D, d M Y', strtotime($this->leave->start_date)),
                'end_date' => date('D, d M Y', strtotime($this->leave->end_date)),
                'date_leave' => str_contains($this->leave->date_leave, '.0') ? str_replace('.0', '', $this->leave->date_leave) : $this->leave->date_leave,
                'apply_date' => date('D, d M Y', strtotime($this->leave->apply_date)),
            ];
            Mail::to($this->staff)->send(new LeaveRejectMail($rejected));
        }
        Mail::to($this->superior)->send(new LeaveNotifyMail($notify));
    }
}
