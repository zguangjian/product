<?php

namespace App\Console\Commands;

use App\Http\Communal\RedisManage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'redisCommands';

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
     * @param Redis $redis
     * @return mixed
     */
    public function handle(Redis $redis)
    {
        //
        // RedisManage::menu(time())->setCacheData(time());
        \Log::info("任务调度:" . date('Y-m-d H:i:s'));

    }
}
