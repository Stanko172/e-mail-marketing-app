<?php

namespace App\Http\Web\Controllers\Mail\Sequence;

use Domain\Mail\Actions\Sequence\CreateSequenceAction;
use Domain\Mail\DataTransferObjects\Sequence\SequenceData;
use Domain\Mail\ViewModels\Sequence\CreateSequenceViewModel;
use Domain\Mail\ViewModels\Sequence\GetSequencesViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class SequenceController
{
    public function index(): InertiaResponse
    {
        return Inertia::render('Sequence/List', [
            'model' => new GetSequencesViewModel(),
        ]);
    }

    public function create(): InertiaResponse
    {
        return Inertia::render('Sequence/Form', [
            'model' => new CreateSequenceViewModel(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $sequence = CreateSequenceAction::execute(
            SequenceData::fromRequest($request),
            $request->user(),
        );

        return to_route('sequences.edit', $sequence);
    }
}
