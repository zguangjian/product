<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends BaseModel
{
    protected $table = "admin";
    protected $primaryKey = "id";

    protected $fillable = ['account', 'email', 'password', 'loginIp', 'status', 'loginTime'];

    protected $hidden = ['password'];
}
