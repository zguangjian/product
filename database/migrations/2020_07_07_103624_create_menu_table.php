<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->default('')->comment('菜单名称');
            $table->string('icon')->default('')->comment('菜单图标');
            $table->integer('parent_id')->default(0)->comment('父级菜单ID');
            $table->string('url')->default('')->comment('菜单链接');
            $table->tinyInteger('status')->default(1)->comment('状态 1显示 2隐藏');
            $table->tinyInteger('sort')->unsigned()->default(0)->comment('排序');
            $table->timeInteger();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
