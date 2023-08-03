<?php

namespace Domain\Mail\ViewModels\Broadcast;

use Domain\Mail\DataTransferObjects\Broadcasts\BroadcastData;
use Domain\Mail\Models\Broadcast\Broadcast;
use Domain\Shared\ViewModels\ViewModel;
use Illuminate\Support\Collection;

class GetBroadcastsViewModel extends ViewModel
{
    /**
     * @return Collection<BroadcastData>
     */
    public function broadcasts(): Collection
    {
        return Broadcast::latest()->get()->map->getData();
    }
}