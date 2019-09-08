<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'proposal_id',
        'courtesy',
        'punctuality',
        'adequacy',
        'task_id',
        'comment'
    ];

    public function proposal(){
        return $this->belongsTo('App\Proposal');
    }

    public function task(){
        return $this->belongsTo('App\Task');
    }

    public function getAVG(){
        return round( ($this->courtesy + $this->punctuality + $this->adequacy) / 3, 1);
    }
}
