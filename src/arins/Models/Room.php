<?php

namespace Arins\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'room';

    protected $fillable = [
        'code',
        'name',
        'displayname',
        'description',
        'numsort',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function roomorders()
    {
        return $this->hasMany('Arins\Models\Roomorders');
    }

}
