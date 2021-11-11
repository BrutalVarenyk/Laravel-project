<?php

namespace App\Notifications;

use App\Mail\Orders\Created\Admin;
use App\Mail\Orders\Created\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class OrderCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user, $orderId, $role;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, int $orderId, bool $role = true)
    {
        $this->orderId = $orderId;
        $this->user = $user;
        $this->role = $role;
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
        return $this->role === true
            ? new Customer($this->orderId, $this->user->full_name)
            : new Admin($this->orderId, $this->user->full_name);
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
