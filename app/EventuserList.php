<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventuserList extends Model
{
     protected $table='event_user_list';
     protected $primaryKey='id';
     protected $fillable = [
        'event_id', 'invitees_email',
    ];
}
