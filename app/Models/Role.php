<?php

namespace App\Models;

use App\Observers\RoleObserve;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
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
 * @mixin Eloquent
 * @property string|null $rule
 * @method static Builder|Role whereRule($value)
 */
class Role extends BaseModel
{
    protected $fillable = ['name', 'content', 'status'];

    public static function boot()
    {
        parent::boot();
        static::observe(RoleObserve::class);
    }
}
