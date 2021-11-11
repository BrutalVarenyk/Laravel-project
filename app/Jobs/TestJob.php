<?php

namespace App\Jobs;

use App\Mail\Orders\Created\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
        logs()->info($this->message . ' - constr');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logs()->info($this->message . ' - handle');
        Mail::to('admin@admin.com')->send(new Admin(32, 'User Name TestJob'));
    }
}
