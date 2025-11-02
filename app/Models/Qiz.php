<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qiz extends Model
{
    protected $table = 'qizlar';
    protected $fillable = ['id','fio','yoshi','sinfi','telefon_raqami','rasmi','manzili'];

    /**
     * Many-to-many relationship with Group model through group_qiz pivot table
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_qiz', 'qiz_id', 'group_id');
    }
}
