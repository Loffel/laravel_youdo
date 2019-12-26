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
        'user_id',
        'notice',
        'logo'
    ];

    protected $dates = [
        'date_end'
    ];

    protected $casts = [
        'notice' => 'array'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function proposals(){
        return $this->hasMany('App\Proposal');
    }

    public function review(){
        return $this->hasOne('App\Review');
    }

    public function payment(){
        return $this->hasOne('App\Payment');
    }

    public function payout(){
        return $this->hasOne('App\Payout');
    }

    public function file(){
        return $this->hasOne('App\File');
    }

    public function selectProposal($id){
        $this->proposal_id = $id;
        $this->save();

        $proposal = $this->getSelectedProposal();
        $proposal->status = 1;
        $proposal->save();

        $payment = \App\Payment::create(array(
            'user_id' => $this->user->id,
            'task_id' => $this->id,
            'amount' => $proposal->price
        ));

        $proposal->user->notify(new UserSelected($this, $proposal->user));

        return true;
    }

    public function getSelectedProposal(){
        $proposal = \App\Proposal::find($this->proposal_id);

        return $proposal;
    }

    public function getLogo(){
        $logo = 'images/company-logo-05.png';
        if($this->logo != NULL) $logo = 'storage/' . $this->logo;

        return asset($logo);
    }
}
