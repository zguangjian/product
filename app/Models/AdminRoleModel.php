<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\AdminRole
 *
 * @property int $id
 * @property int $adminId 管理员ID
 * @property int $roleId 角色ID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRole whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRole whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminRole whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminRoleModel extends BaseModel
{
    protected $table = "admin_role";

    protected $fillable = ['adminId', 'roleId'];
}
