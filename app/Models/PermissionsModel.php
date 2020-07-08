<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PermissionsModel
 *
 * @property int $id
 * @property string $name 菜单名称
 * @property string $url 菜单链接
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel whereUrl($value)
 * @mixin \Eloquent
 */
class PermissionsModel extends BaseModel
{
    protected $table = "permissions";
}
