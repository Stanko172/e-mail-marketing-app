<?php

namespace App\Http\Web\Controllers\Mail\Sequence;

use Domain\Mail\Actions\Sequence\CreateSequenceAction;
use Domain\Mail\Actions\Sequence\DeleteSequenceAction;
use Domain\Mail\DataTransferObjects\Sequence\SequenceData;
use Domain\Mail\Models\Sequence\Sequence;
use Domain\Mail\ViewModels\Sequence\CreateSequenceViewModel;
use Domain\Mail\ViewModels\Sequence\GetSequencesViewModel;
use Domain\Mail\ViewModels\Sequence\EditSequenceContentViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Redirect;

class SequenceController
{
    public function index(): InertiaResponse
    {
        return Inertia::render('Sequence/List', [
            'model' => new GetSequencesViewModel(),
        ]);
    }
}
