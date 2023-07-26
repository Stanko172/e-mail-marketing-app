<?php

namespace Domain\Mail\Models\Broadcast;

use Domain\Mail\Enums\Broadcast\BroadcastStatus;
use Domain\Mail\Models\Casts\FiltersCast;
use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\Concerns\HasUser;
use Spatie\LaravelData\WithData;

class Broadcast extends BaseModel
{
    use WithData;
    use HasUser;

    protected $casts = [
        'filters' => FiltersCast::class,
        'status' => BroadcastStatus::class,
    ];

    protected $attributes = [
        'status' => BroadcastStatus::Draft,
    ];
}
