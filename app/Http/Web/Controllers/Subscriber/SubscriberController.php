<?php

declare(strict_types=1);

namespace App\Http\Web\Controllers\Subscriber;

use Domain\Shared\Actions\UpsertSubscriberAction;
use Domain\Subscriber\DataTransferObjects\SubscriberData;
use Domain\Subscriber\ViewModels\UpsertSubscriberViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SubscriberController
{
    public function create(Request $request): Response
    {
        return Inertia::render(
            'Subscriber/Form',
            new UpsertSubscriberViewModel(),
        );
    } 

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
