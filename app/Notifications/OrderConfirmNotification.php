<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderConfirmNotification extends Notification
{
    use Queueable;
    public $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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

  
    public function toArray($notifiable)
    {
        return [
            'email' => $this->data['email'],
            'title' => $this->data['title'],
            'web' => $this->data['web'],
            'status' => $this->data["order"]['status'],
            'actionURL' => $this->data['actionURL'],
            'url' => route('user.notification', $this->id),
            'fas' => $this->data['fas'],
            'time' => date('F d, Y h:i A')
        ];
    }
}
