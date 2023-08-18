<?php

namespace Arins\Models;

use Illuminate\Database\Eloquent\Model;

class Roomorder extends Model
{

    protected $table = 'room_order';

    protected $fillable = [
        'name',
        'phone_ext',
        'email',
        'room_id',
        'dept_id',
        'orderstatus_id',
        'orderby_id',
        'orderfor_id',
        'participants',
        'snack',
        'subject',
        'description',
        'resolution',
        'image',
        'meetingdt',
        'startdt',
        'enddt',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'meetingdt',
        'startdt',
        'enddt',
        'created_at',
        'updated_at',
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function orderby()
    {
        return $this->belongsTo('App\User', 'orderby_id');
    }

    public function orderfor()
    {
        return $this->belongsTo('App\User', 'orderfor_id');
    }

    public function orderstatus()
    {
        return $this->belongsTo('Arins\Models\Orderstatus', 'orderstatus_id');
    }

    public function room()
    {
        return $this->belongsTo('Arins\Models\Room', 'room_id');
    }

    public function dept()
    {
        return $this->belongsTo('Arins\Models\Dept', 'dept_id');
    }

}
