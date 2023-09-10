<?php

namespace Domain\Mail\Models\Broadcast;

use Domain\Mail\Builders\Broadcast\BroadcastBuilder;
use Domain\Mail\Contracts\Sendable;
use Domain\Mail\DataTransferObjects\Broadcasts\BroadcastData;
use Domain\Mail\DataTransferObjects\PerformanceData;
use Domain\Mail\Enums\Broadcast\BroadcastStatus;
use Domain\Mail\Models\Casts\FiltersCast;
use Domain\Mail\Models\Concerns\HasPerformance;
use Domain\Mail\Models\SentMail;
use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\Concerns\HasUser;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\LaravelData\WithData;

class Broadcast extends BaseModel implements Sendable
{
    use WithData;
    use HasUser;
    use HasPerformance;

    protected $fillable = [
        'id',
        'subject',
        'content',
        'status',
        'filters',
        'sent_at',
        'user_id',
    ];

    protected $casts = [
        'filters' => FiltersCast::class,
        'status' => BroadcastStatus::class,
    ];

    protected $attributes = [
        'status' => BroadcastStatus::Draft,
    ];

    protected $dataClass = BroadcastData::class;

    public function sent_mails(): MorphMany
    {
        return $this->morphMany(SentMail::class, 'sendable');
    }

    public function newEloquentBuilder($query): BroadcastBuilder
    {
        return new BroadcastBuilder($query);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function type(): string
    {
        return $this::class;
    }

    public function performance(): PerformanceData
    {
        $total = SentMail::countOf($this);

        return new PerformanceData(
            total: $total,
            open_rate: $this->openRate($total),
            click_rate: $this->clickRate($total),
        );
    }
}
