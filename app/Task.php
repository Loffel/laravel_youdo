<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\UserSelected;

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

    public function proposals(){
        return $this->hasMany('App\Proposal');
    }

    public function selectProposal($id){
        $this->proposal_id = $id;
        $this->save();

        $proposal = $this->getSelectedProposal();
        $proposal->status = $id;
        $proposal->save();

        $this->user->notify(new UserSelected($this));

        return true;
    }

    public function getSelectedProposal(){
        $proposal = \App\Proposal::find($this->proposal_id);

        return $proposal;
    }
}
