<?php

namespace App\Models;


/**
 * App\Models\Permissions
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $mid 菜单id
 * @property string $name 菜单名称
 * @property string $url 菜单链接
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel whereMid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionsModel whereUrl($value)
 * @property-read \App\Models\MenuModel $belongsToMenu
 */
class PermissionsModel extends BaseModel
{
    protected $fillable = ['mid', 'name', 'url'];

    //
    public function belongsToMenu()
    {
        return $this->belongsTo(MenuModel::class, 'id', 'mid');
    }
}
