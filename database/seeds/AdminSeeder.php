<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //生成100条管理员
        factory(Admin::class, 100)->create();
        Admin::where('id', 1)->update(['account' => 'admin', 'status' => 1]);
    }
}
