<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTAdminTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('account', 64)->comment('帐号');
			$table->string('email', 64)->comment('邮件');
			$table->string('password', 64)->comment('密码');
			$table->string('loginIp', 32)->comment('登录ip');
			$table->boolean('status')->default(1)->comment('状态 1正常 0禁用');
			$table->integer('loginTime')->comment('登录时间');
			$table->integer('created_at')->nullable();
			$table->integer('updated_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t_admin');
	}

}
