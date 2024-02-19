<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\makeGroupEmail;

class SendGroupJoinedMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userEmails;

    /**
     * Create a new job instance.
     */
    public function __construct(array $userEmails)
    {
        $this->userEmails = $userEmails;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->userEmails)->send(new MakeGroupEmail());
    }
}
