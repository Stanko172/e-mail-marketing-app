<?php

declare(strict_types=1);

namespace Domain\Mail\ViewModels\Broadcast;

use Domain\Mail\DataTransferObjects\Broadcasts\BroadcastData;
use Domain\Mail\Models\Broadcast\Broadcast;
use Illuminate\Support\Collection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Spatie\ViewModels\ViewModel;

#[TypeScript]
class GetBroadcastsViewModel extends ViewModel
{
    /**
     * @return Collection<BroadcastData>
     */
    public function broadcasts(): Collection
    {
        return Broadcast::latest()->get()->map->getData();
    }

    /**
     * @return Collection<int, PerformanceData>
     */
    public function performances(): Collection
    {
        return Broadcast::all()
            ->mapWithKeys(fn (Broadcast $broadcast) => [
                $broadcast->id => $broadcast->performance(),
            ]);
    }
}
