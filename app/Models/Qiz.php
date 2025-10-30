<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qiz extends Model
{
    protected $table = 'qizlar';
    protected $fillable = ['id','fio','yoshi','sinfi','rasmi','manzili'];
}
