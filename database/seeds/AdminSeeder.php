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
        //创建管理员帐号
//        AdminModel::create([
//            'account' => 'admin',
//            'email' => 'zguangjian@outlook.com',
//            'password' => hashMake('123456'),
//            'loginIp' => '127.0.0.1',
//            'status' => 1,
//            'loginTime' => time(),
//        ]);
        factory(AdminModel::class, 10)->create();
    }
}
