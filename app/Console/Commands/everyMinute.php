<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class everyMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will update the meeting progress ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
            DB::table('meetings')
                ->where('meetingEndTime','<',\Carbon\Carbon::now())
                ->where('meetingProgress', '!=', 'Completed')
                ->update(['meetingProgress'=>'Completed']);
    }
}
