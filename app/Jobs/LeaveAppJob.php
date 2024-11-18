<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeaveAppMail;

class LeaveAppJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $insert, $superior;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($insert, $superior)
    {
        $this->insert = $insert;
        $this->superior = $superior;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->insert->half_day == 0) {
            $details = [
                'superior' => $this->insert->getStaff->getSuperior->name,
                'staff' => $this->insert->getStaff->getUser->name,
                'leavetype' => $this->insert->getLeaveType->name,
                'startdate' => date('D, d M Y', strtotime($this->insert->start_date)),
                'enddate' => date('D, d M Y', strtotime($this->insert->end_date)),
                'dateleave' => str_contains($this->insert->date_leave, '.0') ? str_replace('.0', '', $this->insert->date_leave) : $this->insert->date_leave
            ];
            // Mail::to($this->superior)->send(new LeaveAppMail($details));
        } elseif($this->insert->half_day == 1 || $this->insert->half_day == 2) {
            $details = [
                'superior' => $this->insert->getStaff->getSuperior->name,
                'staff' => $this->insert->getStaff->getUser->name,
                'leavetype' => $this->insert->getLeaveType->name,
                'startdate' => date('D, d M Y', strtotime($this->insert->start_date)),
                'enddate' => date('D, d M Y', strtotime($this->insert->end_date)),
                'dateleave' => str_contains($this->insert->date_leave, '.0') ? str_replace('.0', '', $this->insert->date_leave) : $this->insert->date_leave
            ];
            // Mail::to($this->superior)->send(new LeaveAppMail($details));
        }
    }
}
