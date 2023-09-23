<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DailyOpenResto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-open-resto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Open Resto';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        DB::table('open_resto')
              ->where('id', 1)
              ->update(['is_open' => 1]);
    }
}
