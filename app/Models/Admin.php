<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Admin
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Admin whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Admin whereLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Admin whereLoginTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Admin whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Admin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Admin extends BaseModel
{
    protected $table = "admin";
    protected $primaryKey = "id";

    protected $fillable = ['account', 'email', 'password', 'loginIp', 'status', 'loginTime'];

    protected $hidden = ['password'];
}
