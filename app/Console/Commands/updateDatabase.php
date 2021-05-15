<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Discount;

class updateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update_database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ini akan update database';

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
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now()->format('Y-m-d');
        Discount::where('end', $now)->delete();
        
        DB::table('log')->insert([
            'log' => "This is a message from laravel scheduler with every 1 minute...",
            'created_at' => date("Y-m-d h:i:s")
        ]);
        echo"operasi berhasil";
    }
}
