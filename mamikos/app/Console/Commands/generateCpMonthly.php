<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class generateCpMonthly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cp:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate credit point for user monthly';

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
    public function handle()
    {
        User::all()->map(function($val) {
            if ($val->role_id == 3) {
                $val->credit_point = USER::REGULAR_POINT;
            } else if ($val->role_id == 4) {
                $val->credit_point = USER::PREMIUM_POINT;
            }
            $val->save();
            return $val;
        });
    }
}
