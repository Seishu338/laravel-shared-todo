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
use LINE\Clients\MessagingApi\Model\PushMessageRequest;
use LINE\Clients\MessagingApi\Model\TextMessage;

class SendGroupJoinedMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users;

    /**
     * Create a new job instance.
     */
    public function __construct(array $users)
    {
        $this->users = $users;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->users as $user) {
            if ($user->line_id) {
                $client = new \GuzzleHttp\Client();
                $config = new \LINE\Clients\MessagingApi\Configuration();
                $config->setAccessToken(config('services.line.channel_token'));
                $messagingApi = new \LINE\Clients\MessagingApi\Api\MessagingApiApi(
                    $client,
                    $config,
                );

                $message = new TextMessage(['type' => 'text', 'text' => 'グループが作成されました!']);
                $pushMessageirequest = new PushMessageRequest(['to' => $user->line_id, 'messages' => [$message]]);
                $messagingApi->pushMessage($pushMessageirequest);
            } else {
                Mail::to($user->email)->send(new MakeGroupEmail());
            }
        }
    }
}
