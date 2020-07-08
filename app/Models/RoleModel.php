<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\RoleModel
 *
 * @property int $id
 * @property string $name 角色名
 * @property string $content 描述
 * @property int $status 状态  0关闭 1开启
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\RoleModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\RoleModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\RoleModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\RoleModel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\RoleModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\RoleModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\RoleModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\RoleModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\RoleModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RoleModel extends BaseModel
{
    protected $table = "role";

    protected $fillable = ['name', 'content', 'status'];
}
