<?php

namespace App\Mail\Orders\Created;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BaseMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected $orderId, $fullname;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $orderId, $user_fn)
    {
        $this->orderId = $orderId;
        $this->fullname = $user_fn;
    }

}
