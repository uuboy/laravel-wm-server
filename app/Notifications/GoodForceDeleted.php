<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Good;

class GoodForceDeleted extends Notification
{
    use Queueable;

    public $good;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Good $good)
    {
        $this->good = $good;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->good->id,
            'model' => 'good',
            'method' => 'force_delete',
            'model_name' => $this->good->name,
            'user_id' => $this->good->lastUpdater->id,
            'user_name' => $this->good->lastUpdater->name,
            'user_avatar' => $this->good->lastUpdater->avatar,
        ];

    }
}
