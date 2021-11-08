<?php

namespace App\Mail\Orders\Created;

class Customer extends BaseMailable
{
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.order_created.customer')
            ->with(['order_id' => $this->orderId, 'full_name' => $this->fullname]);
    }
}
