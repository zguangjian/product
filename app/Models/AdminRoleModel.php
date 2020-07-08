<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\AdminRoleModel
 *
 * @property int $id
 * @property int $adminId 管理员ID
 * @property int $roleId 角色ID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRoleModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRoleModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRoleModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRoleModel whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRoleModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRoleModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRoleModel whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRoleModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminRoleModel extends BaseModel
{
    protected $table = "admin_role";

    protected $fillable = ['adminId', 'roleId'];
}
