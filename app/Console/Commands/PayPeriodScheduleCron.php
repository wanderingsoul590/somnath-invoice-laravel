<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PayPeriodSchedule;

class PayPeriodScheduleCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'everyDay:PayPeriodScheduleCron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create pay period schedule.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        PayPeriodSchedule::insertHostPayoutPeriodEntry();
    }
}
