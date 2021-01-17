<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\ClientRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewRequest;

class ProcessRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $clientRequest;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ClientRequest $clientRequest)
    {
        $this->clientRequest = $clientRequest;

        $this->onQueue('processing')
            ->onConnection('sqs');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::findOrFail($this->clientRequest->user_id);

        // Mailing new request

        Mail::to($this->clientRequest->vendor->email)
            ->send(new NewRequest($this->clientRequest));

        $this->clientRequest->update(['status' => ClientRequest::STATUS_SENT]);
    }
}
