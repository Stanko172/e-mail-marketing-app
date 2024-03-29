<?php

namespace Domain\Mail\DataTransferObjects\Broadcasts;

use Carbon\Carbon;
use Domain\Mail\DataTransferObjects\FilterData;
use Domain\Mail\Enums\Broadcast\BroadcastStatus;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class BroadcastData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $subject,
        public readonly string $content,
        public readonly ?FilterData $filters,
        public readonly ?Carbon $sent_at,
        #[WithCast(EnumCast::class)]
        public readonly ?BroadcastStatus $broadcastStatus = BroadcastStatus::Draft,
    ) {
    }
}
