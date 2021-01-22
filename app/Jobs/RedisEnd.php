<?php

namespace App\Jobs;

use App\Http\Communal\RedisManage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Throwable;

class RedisEnd implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderId;

    /**
     * 最大失败次数
     * @var int
     */
    public $tries = 5;

    /**
     * 最大异常数
     * @var int
     */
    public $maxExceptions = 3;

    /**
     * 超时
     * @var int
     */
    public $timeout = 120;

    /**
     * Create a new job instance.
     *
     * @param $orderId
     */
    public function __construct($orderId)
    {
        //
        $this->orderId = $orderId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //处理业务逻辑
        RedisManage::menu($this->orderId)->setCacheData(time());
    }

    /**
     * @param Throwable $throwable
     */
    public function fail(Throwable $throwable)
    {
    }
}
