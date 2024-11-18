<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\LeaveQuota;

class ResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Leave Quota Every 1 January';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $year = date('Y');
        $delete = LeaveQuota::where('year', $year - 1)->where('delete_quota', 0)->get();
        foreach ($delete as $d) {
            $d->delete_quota = 1;
            $d->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
            $d->save();
            $new = new LeaveQuota();
            $new->staff_id = $d->staff_id;
            $new->year = $year;
            $new->default = $d->default;
            $new->balance = $d->balance;
            $new->mc_default = $d->mc_default;
            $new->mc_balance = $d->mc_balance;
            $new->taken = 0;
            $new->mc_taken = 0;
            if ($d->maternity == 0) {
                $new->maternity = 60;
            } else {
                $new->maternity = $d->maternity;
            }
            if ($d->paternity == 0) {
                $new->paternity = 3;
            } else {
                $new->paternity = $d->paternity;
            }
            $new->delete_quota = 0;
            $new->save();
        }
    }
}
