<?php

namespace Domain\Mail\ViewModels\Sequence;

use Domain\Mail\DataTransferObjects\PerformanceData;
use Domain\Mail\DataTransferObjects\Sequence\SequenceData;
use Domain\Mail\Models\Sequence\Sequence;
use Illuminate\Support\Collection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Spatie\ViewModels\ViewModel;

#[TypeScript]
class GetSequencesViewModel extends ViewModel
{
    /**
     * @return Collection<SequenceData>
     */
    public function sequences(): Collection
    {
        return Sequence::query()
            ->with('mails')
            ->latest()
            ->get()
            ->map->getData();
    }

    /**
     * @return Collection<int, PerformanceData>
     */
    public function performances(): Collection
    {
        return Sequence::all()
            ->mapWithKeys(fn (Sequence $sequence) => [
                $sequence->id => $sequence->performance(),
            ]);
    }
}
