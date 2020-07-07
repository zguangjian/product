<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account', 32)->comment('帐号');
            $table->string('name', 64)->comment('名称');
            $table->string('password', 64)->comment('密码');
            $table->string('loginIp', 32)->comment('登录ip');
            $table->integer('loginTime')->comment('登录时间');
            $table->timeInt();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
