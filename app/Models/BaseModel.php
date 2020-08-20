<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\BaseModel query()
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    //自动更新时间字段
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    //更新时间默认时间戳
    protected $dateFormat = 'U';

}
