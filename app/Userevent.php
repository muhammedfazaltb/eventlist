<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userevent extends Model
{
    //
    protected $table='user_event';
    protected $primaryKey='id';
     protected $fillable = [
        'user_id', 'event_name', 'start_date','end_date',
    ];
}
