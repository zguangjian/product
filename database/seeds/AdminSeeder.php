<?php

use App\Models\AdminRoleModel;
use App\Models\MenuModel;
use App\Models\RoleModel;
use Illuminate\Database\Seeder;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Artisan;

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
        factory(AdminModel::class, 50)->create();
        AdminModel::findOne(['id' => 1])->update(['account' => 'admin', 'status' => 1]);

        $list = "[{\"id\":1,\"name\":\"\u7f51\u7ad9\u8bbe\u7f6e\",\"icons\":\"layui-icon-home\",\"parent_id\":0,\"url\":null,\"status\":1,\"sort\":1,\"content\":null,\"created_at\":\"1603335738\",\"updated_at\":\"1603335738\"},{\"id\":3,\"name\":\"\u4eba\u5458\u7ba1\u7406\",\"icons\":\"layui-icon-username\",\"parent_id\":0,\"url\":\"\/admin\/admin\/index\",\"status\":1,\"sort\":1,\"content\":null,\"created_at\":\"1603336483\",\"updated_at\":\"1603435913\"},{\"id\":2,\"name\":\"\u83dc\u5355\u7ba1\u7406\",\"icons\":\"layui-icon-spread-left\",\"parent_id\":1,\"url\":\"\/admin\/menu\/index\",\"status\":1,\"sort\":9,\"content\":null,\"created_at\":\"1603336416\",\"updated_at\":\"1603336416\"},{\"id\":4,\"name\":\"\u7ba1\u7406\u5458\",\"icons\":null,\"parent_id\":3,\"url\":\"\/admin\/admin\/index\",\"status\":1,\"sort\":999,\"content\":null,\"created_at\":\"1603336581\",\"updated_at\":\"1603423399\"},{\"id\":5,\"name\":\"\u89d2\u8272\u7ba1\u7406\",\"icons\":null,\"parent_id\":3,\"url\":\"\/admin\/role\/index\",\"status\":1,\"sort\":999,\"content\":null,\"created_at\":\"1603336718\",\"updated_at\":\"1603348354\"},{\"id\":6,\"name\":\"\u65e5\u5fd7\u67e5\u8be2\",\"icons\":\"layui-icon-form\",\"parent_id\":0,\"url\":\"\/admin\/log\/index\",\"status\":1,\"sort\":999,\"content\":null,\"created_at\":\"1603435501\",\"updated_at\":\"1603435862\"},{\"id\":7,\"name\":\"\u57fa\u7840\u8bbe\u7f6e\",\"icons\":null,\"parent_id\":1,\"url\":null,\"status\":1,\"sort\":999,\"content\":null,\"created_at\":\"1603439698\",\"updated_at\":\"1603439698\"},{\"id\":8,\"name\":\"\u4eba\u5458\u65e5\u5fd7\",\"icons\":null,\"parent_id\":0,\"url\":\"\/admin\/log\/index\",\"status\":1,\"sort\":999,\"content\":null,\"created_at\":\"1603790108\",\"updated_at\":\"1603869130\"}]";
//        foreach (json_decode($list, true) as $value) {
//
//        }
        MenuModel::createAll(json_decode($list, true));

        RoleModel::createAll([
            ["name" => "超级管理员", "content" => "网站超级管理员", "status" => 1],
            ["name" => "管理员", "content" => "网站管理员", "status" => 1],
        ]);

        AdminRoleModel::create(['adminId' => 1, 'roleId' => 1]);
        AdminRoleModel::create(['adminId' => 2, 'roleId' => 2]);
        Artisan::call('cache:clear');
    }
}
