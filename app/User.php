<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Task;
use App\Review;
use App\Proposal;
use Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ogrn', 'type', 'phone', 'legal_address', 'address', 'avatar', 'about'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTypeName(){
        $name = '';
        if($this->type == 1) $name = 'Заказчик';
        else if($this->type == 2) $name = 'Исполнитель';

        return $name;
    }

    public function getAvatar(){
        $avatar = 'images/user-avatar-placeholder.png';
        if($this->avatar != NULL) $avatar = $this->avatar;
        
        return asset('storage/'.$avatar);
    }

    public function getScoreAVG(){

        $reviews = $this->reviews();

        $avg = 0;

        foreach($reviews as $review){
            $avg += $review->getAVG();
        }

        if($reviews->count() != 0)
            $avg = round($avg / $reviews->count(), 1);

        return $avg;
    }

    public function reviews(){
        if($this->type == 1){
            $tasks = $this->tasks->where('proposal_id', '!=', NULL);
            $proposals = Proposal::whereIn('status', array(4,6))->whereIn('task_id', $tasks)->get();        
            $reviews = Review::whereIn('proposal_id', $proposals)->get();
        }else{
            $proposals = $this->proposals->whereIn('status', array(4, 6));
            $tasks = Task::whereIn('proposal_id', $proposals)->get();

            $reviews = Review::whereIn('task_id', $tasks)->get();
        }

        return $reviews;
    }

    public function tasks(){
        return $this->hasMany('App\Task');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function proposals(){
        return $this->hasMany('App\Proposal');
    }

    public function messages(){
        return $this->hasMany('App\Message', 'to_id', 'id');
    }

    public function unreadMessages(){
        return $this->messages()->where('read', 0)->orderBy('id', 'desc')->get();
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }

    public function payouts(){
        return $this->hasMany('App\Payment');
    }

    public function isOnline(){
        return Cache::has('user-online-'.$this->id);
    }
}
