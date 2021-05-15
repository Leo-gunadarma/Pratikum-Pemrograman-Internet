<?php

namespace App\Console;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:update_database')->everyMinute();
        // $schedule->call(function () {
        
        //     DB::table('discounts')
        //     ->where('end', "now()")
        //     ->update(['percentage' => "", 'start' => "", 'end' => ""]);
            
        // })->everyMinute();

        // $schedule->call(function () {

        //     DB::table('log')->insert([
        //         'log' => "This is a message from laravel scheduler with every 1 minute...",
        //         'created_at' => date("Y-m-d h:i:s")
        //     ]);
    
        // })->everyMinute();
    
        // $schedule->call(function () {
        //     DB::table('log')->insert([
        //         'log' => "This is a message from laravel scheduler with every 5 minute...",
        //         'created_at' => date("Y-m-d h:i:s")
        //     ]);
    
        // })->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
