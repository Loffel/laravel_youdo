<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'from_id',
        'to_id',
        'text'
    ];

    public function from(){
        return $this->hasOne('App\User', 'id', 'from_id');
    }

    public function to(){
        return $this->hasOne('App\User', 'id', 'to_id');
    }
}
