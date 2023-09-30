<?php

namespace Domain\Mail\ViewModels\Sequence;

use Domain\Shared\ViewModels\Concerns\HasForms;
use Domain\Shared\ViewModels\Concerns\HasTags;
use Domain\Shared\ViewModels\ViewModel;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class CreateSequenceViewModel extends ViewModel
{
    use HasTags;
    use HasForms;
}
