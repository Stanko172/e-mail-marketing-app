<?php

namespace Domain\Mail\Models\Broadcast;

use Domain\Mail\Builders\Broadcast\BroadcastBuilder;
use Domain\Mail\Contracts\Sendable;
use Domain\Mail\DataTransferObjects\Broadcasts\BroadcastData;
use Domain\Mail\DataTransferObjects\FilterData;
use Domain\Mail\DataTransferObjects\PerformanceData;
use Domain\Mail\Enums\Broadcast\BroadcastStatus;
use Domain\Mail\Models\Casts\FiltersCast;
use Domain\Mail\Models\Concerns\HasPerformance;
use Domain\Mail\Models\SentMail;
use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\Concerns\HasUser;
use Domain\Subscriber\Models\Concerns\HasAudience;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\LaravelData\WithData;

class Broadcast extends BaseModel implements Sendable
{
    use HasAudience;
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
        'sent_at' => 'datetime',
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

    public function id(): int
    {
        return $this->id;
    }

    public function type(): string
    {
        return $this::class;
    }

    public function subject(): string
    {
        return $this->subject;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function filters(): FilterData
    {
        return $this->filters;
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

    protected function audienceQuery(): Builder
    {
        return Subscriber::query();
    }
}
