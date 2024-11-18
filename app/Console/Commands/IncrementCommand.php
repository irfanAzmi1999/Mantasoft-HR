<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\LeaveQuota;

class IncrementCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'increment:increment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment Leave Entitlement Every 1 Year of Staff Employment Date until 20';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now()->format('m-d');
        $year = date('Y');
        $data = LeaveQuota::where('year', $year)->where('delete_quota', 0)->get();
        foreach ($data as $d) {
            $employ = date('m-d', strtotime($d->getStaff->employ_date));
            if ($employ == $today && $d->default < 20) {
                $d->default += 1;
            }
            if ($employ == $today && $d->balance < 20) {
                $d->balance += 1;
            }
            if ($employ == $today && $d->mc_default < 20) {
                $d->mc_default += 1;
            }
            if ($employ == $today && $d->mc_balance < 20) {
                $d->mc_balance += 1;
            }
            $d->save();
        }
    }
}
