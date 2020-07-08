<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminModel
 *
 * @package App\Http\Models
 * @property string $account
 * @property string $email
 * @property string $password
 * @property string $loginIp
 * @property int $status
 * @property int $loginTime
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminModel whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminModel whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminModel whereLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminModel whereLoginTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminModel wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\AdminModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminModel extends BaseModel
{
    protected $table = "admin";
    protected $primaryKey = "id";

    protected $fillable = ['account', 'email', 'password', 'loginIp', 'status', 'loginTime'];
}
