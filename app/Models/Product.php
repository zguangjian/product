<?php
namespace App\Models;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
/**
 * @Author: Marte
 * @Date:   2020-11-17 20:10:45
 * @Last Modified by:   Marte
 * @Last Modified time: 2020-11-17 20:59:54
 */
class Product extends BaseModel
{
    protected $table = 'product';
    protected $pk = 'id';
    protected $fillable = ['id','name','store','pic','status'];
}