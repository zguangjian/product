<?php

use Illuminate\Database\Seeder;
use App\Models\AdminModel;

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
        factory(AdminModel::class, 100)->create();
        AdminModel::where('id', 1)->update(['account' => 'admin']);
    }
}
