<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductAppearedNotification extends Notification
{
    use Queueable;

    protected $product;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
//    public function __construct(Product $product)
//    {
//        logs()->info('App\Notifications\ProductAppearedNotification  __construct');
//        $this->product = $product;
//    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        logs()->info('App\Notifications\ProductAppearedNotification  via');
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $this->product = Product::find(1)->get();
        logs()->info('INIT: toMail');
        $url = route('lang.products.show', $this->product);
        logs()->info('END: toMail');
        return (new MailMessage)
            ->line("The product {$this->product->title} from your wishlist")
            ->line('was appeared in stock')
            ->action('Go to product Page', $url)
            ->line('Thank you for using our shop!');
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
