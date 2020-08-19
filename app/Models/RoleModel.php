<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Role
 *
 * @property int $id
 * @property string $name 角色名
 * @property string $content 描述
 * @property int $status 状态  0关闭 1开启
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Role whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Role whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends BaseModel
{
    protected $table = "role";

    protected $fillable = ['name', 'content', 'status'];
}
