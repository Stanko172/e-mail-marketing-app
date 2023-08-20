<?php

namespace App\Http\Web\Controllers\Mail\Broadcast;

use App\Http\Controllers\Controller;
use Domain\Mail\Actions\Broadcast\UpsertBroadcastAction;
use Domain\Mail\DataTransferObjects\Broadcasts\BroadcastData;
use Domain\Mail\Models\Broadcast\Broadcast;
use Domain\Mail\ViewModels\Broadcast\GetBroadcastsViewModel;
use Domain\Mail\ViewModels\Broadcast\UpsertBroadcastViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BroadcastController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Broadcast/List', [
            'model' => new GetBroadcastsViewModel(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Broadcast/Form', [
            'model' => new UpsertBroadcastViewModel(),
        ]);
    }

    public function store(BroadcastData $data, Request $request): RedirectResponse
    {
        UpsertBroadcastAction::execute($data, $request->user());

        $this->toast('Broadcast successfully created.');

        return to_route('broadcasts.index');
    }

    public function edit(Broadcast $broadcast): Response
    {
        return Inertia::render('Broadcast/Form', [
            'model' => new UpsertBroadcastViewModel($broadcast),
        ]);
    }

    public function update(BroadcastData $data, Request $request): RedirectResponse
    {
        UpsertBroadcastAction::execute($data, $request->user());

        $this->toast('Broadcast successfully updated.');

        return to_route('broadcasts.index');
    }
}
