<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 128)->default('')->comment('菜单名称');
			$table->string('icon', 64)->default('')->comment('菜单图标');
			$table->integer('parent_id')->default(0)->comment('父级菜单ID');
			$table->string('url')->default('')->comment('菜单链接');
			$table->boolean('status')->default(1)->comment('状态 1显示 2隐藏');
			$table->boolean('sort')->default(0)->comment('排序');
			$table->string('content')->nullable()->comment('描述');
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
		Schema::drop('t_menu');
	}

}
