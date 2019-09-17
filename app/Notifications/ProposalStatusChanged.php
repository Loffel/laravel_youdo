<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProposalStatusChanged extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($task, $user)
    {
        $this->task = $task;
        $this->user = $user;

        $message = "";

        $status = $task->getSelectedProposal()->status;

        switch($status){
            case 2:
                $message = $user->name.' указал, что задание "'.$task->title.'" выполнено.';
                break;
            case 3:
                $message = $user->name.' принял вашу работу по заданию "'.$task->title.'".';
                break;
            case 5:
                $message = 'Задание "'.$task->title.'" отправлено в арбитраж.';
                break;
        }

        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Статус вашего задания изменен!')
                    ->line($this->message)
                    ->line('Спасибо за использование нашего сайта!');
    }

    public function toDatabase($notifiable){
        return [
            'user_name' => $this->task->getSelectedProposal()->user->name,
            'user_id' => $this->task->getSelectedProposal()->user->id,
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'message' => $this->message
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
