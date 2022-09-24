<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderSubmit extends Notification
{
    use Queueable;
    public $post_data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post_data)
    {
        $this->post_data=$post_data;
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
            'name' => $this->post_data['cus_name'],
            'email' => $this->post_data['cus_email'],
            'phone' => $this->post_data['cus_phone'],
            'amount' => $this->post_data['total_amount'],
            'address' => $this->post_data['cus_add1'],
            'state' => $this->post_data['cus_state'],
            'title' => $this->post_data['title'],
            'actionURL' => $this->post_data['actionURL'],
            'url' => route('admin.notification', $this->id),
            'fas' => $this->post_data['fas'],
            'time' => date('F d, Y h:i A')
        ];
    }
}
