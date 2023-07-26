<?php

namespace Domain\Mail\Models\Casts;

use Domain\Mail\DataTransferObjects\FilterData;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class FiltersCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): FilterData
    {
        $filterArray = json_decode($value, true);

        return $filterArray
            ? FilterData::from($filterArray)
            : FilterData::from(FilterData::empty());
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        return [
            'filters' => json_encode($value),
        ];
    }
}
