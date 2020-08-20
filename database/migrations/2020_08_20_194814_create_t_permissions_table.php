<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permissions', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->boolean('mid')->comment('菜单id');
			$table->string('name')->default('')->comment('菜单名称');
			$table->string('url')->default('')->comment('菜单链接');
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
		Schema::drop('t_permissions');
	}

}
