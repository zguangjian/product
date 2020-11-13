<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Http\Models\Role
 *
 * @property int $id
 * @property string $name 角色名
 * @property string $content 描述
 * @property int $status 状态  0关闭 1开启
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|\App\Http\Models\Role newModelQuery()
 * @method static Builder|\App\Http\Models\Role newQuery()
 * @method static Builder|\App\Http\Models\Role query()
 * @method static Builder|\App\Http\Models\Role whereContent($value)
 * @method static Builder|\App\Http\Models\Role whereCreatedAt($value)
 * @method static Builder|\App\Http\Models\Role whereId($value)
 * @method static Builder|\App\Http\Models\Role whereName($value)
 * @method static Builder|\App\Http\Models\Role whereStatus($value)
 * @method static Builder|\App\Http\Models\Role whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string|null $rule
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereRule($value)
 */
class Role extends BaseModel
{
    protected $table = "role";

    protected $fillable = ['name', 'content', 'status'];
}
