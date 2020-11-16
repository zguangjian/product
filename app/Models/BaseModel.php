<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


/**
 * App\Models\BaseModel
 *
 * @method static Builder|BaseModel newModelQuery()
 * @method static Builder|BaseModel newQuery()
 * @method static Builder|BaseModel query()
 * @mixin Eloquent
 */
class BaseModel extends Model
{
    //自动更新时间字段
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    //更新时间默认时间戳
    protected $dateFormat = 'U';

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table ? $this->table : strtolower(snake_case(class_basename($this)));
    }

    /**
     * @param $attribute
     * @return bool
     */
    public static function createAll($attribute)
    {
        return DB::table((new static())->getTable())->insert($attribute);
    }

    /**
     * @param $attribute
     * @return Model|object|null
     */
    public static function findOne($attribute = [])
    {
        return (new static())->where($attribute)->first();
    }

    /**
     * @param $attribute
     * @return Collection
     */
    public static function findAll($attribute = [])
    {
        return (new static())->where($attribute)->get();
    }

}

