<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'date_end',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
