<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string $account 帐号
 * @property string $email 邮件
 * @property string $password 密码
 * @property string $loginIp 登录ip
 * @property int $status 状态 1正常 0禁用
 * @property int $loginTime 登录时间
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|AdminModel newModelQuery()
 * @method static Builder|AdminModel newQuery()
 * @method static Builder|AdminModel query()
 * @method static Builder|AdminModel whereAccount($value)
 * @method static Builder|AdminModel whereCreatedAt($value)
 * @method static Builder|AdminModel whereEmail($value)
 * @method static Builder|AdminModel whereId($value)
 * @method static Builder|AdminModel whereLoginIp($value)
 * @method static Builder|AdminModel whereLoginTime($value)
 * @method static Builder|AdminModel wherePassword($value)
 * @method static Builder|AdminModel whereStatus($value)
 * @method static Builder|AdminModel whereUpdatedAt($value)
 * @mixin Eloquent
 */
class AdminModel extends BaseModel
{
    protected $table = "admin";
    protected $primaryKey = "id";

    protected $fillable = ['account', 'email', 'password', 'loginIp', 'status', 'loginTime'];

    protected $hidden = ['password'];
}
