<?php

namespace App\Notifications;

use App\Mail\Orders\Created\Admin;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class OrderCreatedNotification extends Notification
{


    protected $user, $orderId;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, int $orderId)
    {
        $this->orderId = $orderId;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toMail($notifiable)
    {
//        $themes = [
//            'admin' => 'email.order_created.admin',
//            'customer' => 'email.order_created.customer'
//        ];
//        $key = is_admin($this->user) ? 'admin' : 'customer';


        logs()->debug(self::class . '@toMail');
        return (new Admin(35, 'User Name Notification'));

//        return (new Admin($this->orderId, $this->user->full_name));

//        Mail::to($this->user->email)->send(new Admin($this->orderId, $this->user->full_name));

//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
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
