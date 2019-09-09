<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewProposal extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($task, $proposal)
    {
        $this->task = $task;
        $this->proposal = $proposal;
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
                    ->subject('К вашему заданию оставили новое предложение!')
                    ->line($this->proposal->user->name.' оставил предложение к вашему заданию "'.$this->task->title.'".')
                    ->action('Посмотреть предложения', route('tasks.show', $this->task->id))
                    ->line('Спасибо за использование нашего сайта!');
    }

    public function toDatabase($notifiable){
        return [
            'user_name' => $this->proposal->user->name,
            'user_id' => $this->proposal->user->id,
            'task_id' => $this->task->id,
            'task_title' => $this->task->title
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
