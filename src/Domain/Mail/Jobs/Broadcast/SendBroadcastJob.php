<?php

declare(strict_types=1);

namespace Domain\Mail\Jobs\Broadcast;

use Domain\Mail\Actions\Broadcast\SendBroadcastAction;
use Domain\Mail\Models\Broadcast\Broadcast;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendBroadcastJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        private readonly Broadcast $broadcast,
    ) {
    }

    public function handle(): void
    {
        SendBroadcastAction::execute($this->broadcast);
    }
}
