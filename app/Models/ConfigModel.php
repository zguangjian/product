<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Config
 *
 * @property int $id
 * @property string $name 配置名
 * @property string $val 配置内容json
 * @property string|null $content 描述
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfigModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfigModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfigModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfigModel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfigModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfigModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfigModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfigModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfigModel whereVal($value)
 * @mixin \Eloquent
 */
class ConfigModel extends BaseModel
{
    protected $table = "config";

}
