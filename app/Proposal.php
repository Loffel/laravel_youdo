<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'description',
        'price',
        'user_id',
        'task_id',
        'status'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function task(){
        return $this->belongsTo('App\Task');
    }

    public function review(){
        return $this->hasOne('App\Review');
    }

    /**
     * Статусы
     * 
     * 0 - новая
     * 1 - в работе (исполнитель назначан)
     * 2 - готово, не принятно заказчиком
     * 3 - принято, не оплачено
     * 4 - принято и оплачено
     * 5 - арбитраж
     * 6 - отменено исполнителем
     * 7 - отменено заказчиком
     * 8 - деньги возвращены заказчику
     */
    
    public function getStatusText(){
        $status = "";

        switch($this->status){
            case 0:
                $status = 'Новая заявка';
                break;
            case 1:
                $status = 'В работе';
                break;
            case 2:
                $status = 'Готово, не принято заказчиком';
                break;
            case 3:
                $status = 'Принято, не оплачено';
                break;
            case 4:
                $status = 'Принято и оплачено';
                break;
            case 5:
                $status = 'Арбитраж';
                break;
            case 6:
                $status = 'Отменено заказчиком';
                break;
            case 7:
                $status = 'Деньги возвращены заказчику';
                break;
        }

        return $status;
    }
}
