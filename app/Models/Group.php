<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Many-to-many relationship with Qiz model through group_qiz pivot table
     */
    public function qizlar()
    {
        return $this->belongsToMany(Qiz::class, 'group_qiz', 'group_id', 'qiz_id');
    }
}

