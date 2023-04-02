<?php

declare(strict_types=1);

use Domain\Shared\Actions\UpsertSubscriberAction;
use Domain\Subscriber\DataTransferObjects\SubscriberData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class SubscriberController
{
    public function store(SubscriberData $data, Request $request): RedirectResponse
    {
        UpsertSubscriberAction::execute($data, $request->user());

        return Redirect::route('subscribers.index');
    }

    public function update(SubscriberData $data, Request $request): RedirectResponse
    {
        UpsertSubscriberAction::execute($data, $request->user());

        return Redirect::route('subscribers.index');
    }
}
