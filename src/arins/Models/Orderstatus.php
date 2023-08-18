<?php

namespace Arins\Models;

use Illuminate\Database\Eloquent\Model;

class Orderstatus extends Model
{

    protected $table = 'orderstatus';

    protected $fillable = [
        'name',
        'description',
        'image',
        "numsort",
        'status',
    ];

    public function roomorders()
    {
        return $this->hasMany('Arins\Models\Roomorders');
    }

}
