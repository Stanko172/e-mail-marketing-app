<?php

namespace App\Http\Web\Controllers\Mail\Broadcast;

use App\Http\Controllers\Controller;
use Domain\Mail\Jobs\Broadcast\SendBroadcastJob;
use Domain\Mail\Models\Broadcast\Broadcast;
use Illuminate\Http\RedirectResponse;

class SendBroadcastController extends Controller
{
    public function __invoke(Broadcast $broadcast): RedirectResponse
    {
        SendBroadcastJob::dispatch($broadcast);

        $this->toast('Broadcast successfully sent.');

        return to_route('broadcasts.index');
    }
}
