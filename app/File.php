<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'user_id',
        'task_id',
        'name',
        'path',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function task(){
        return $this->belongsTo('App\Task');
    }

    public function getURI(){
        if(!empty($this->path)) return Storage::url($this->path);
        else return "";
    }
}
