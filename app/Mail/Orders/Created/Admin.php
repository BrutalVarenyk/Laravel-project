<?php

namespace App\Mail\Orders\Created;


class Admin extends BaseMailable
{
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        logs()->debug(self::class . '@build');

        return $this->markdown('email.order_created.admin')
            ->with(['order_id' => $this->orderId, 'full_name' => $this->fullname]);

    }
}
