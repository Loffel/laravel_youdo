<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ogrn', 'type', 'phone', 'legal_address', 'address',
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

    public function tasks(){
        return $this->hasMany('App\Task');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function proposals(){
        return $this->hasMany('App\Proposal');
    }
}
