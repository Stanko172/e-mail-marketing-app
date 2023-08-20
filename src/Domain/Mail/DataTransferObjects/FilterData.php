<?php

namespace Domain\Mail\DataTransferObjects;

use Spatie\LaravelData\Data;

class FilterData extends Data
{
    public function __construct(
        public readonly array $tag_ids = [],
        public readonly array $form_ids = [],
    ) {
    }
}
