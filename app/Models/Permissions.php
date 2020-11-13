<?php

namespace App\Models;


/**
 * App\Models\Permissions
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $mid 菜单id
 * @property string $name 菜单名称
 * @property string $url 菜单链接
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereMid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereUrl($value)
 * @property-read \App\Models\Menu $belongsToMenu
 */
class Permissions extends BaseModel
{
    protected $fillable = ['mid', 'name', 'url'];

    //
    public function belongsToMenu()
    {
        return $this->belongsTo(Menu::class, 'id', 'mid');
    }
}
