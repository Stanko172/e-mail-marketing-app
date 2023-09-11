<?php

declare(strict_types=1);

namespace Domain\Subscriber\Models;

use Domain\Mail\Models\SentMail;
use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\Concerns\HasUser;
use Domain\Subscriber\DataTransferObjects\SubscriberData;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Spatie\LaravelData\WithData;

class Subscriber extends BaseModel
{
    use Notifiable;
    use WithData;
    use HasUser;

    protected $dataClass = SubscriberData::class;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'form_id',
        'user_id',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class)
            ->withDefault();
    }

    public function received_mails(): HasMany
    {
        return $this->hasMany(SentMail::class);
    }

    public function last_received_mail(): HasOne
    {
        return $this->hasOne(SentMail::class)
            ->latestOfMany()
            ->withDefault();
    }

    public function fullName(): Attribute
    {
        return new Attribute(
            get: fn () => "{$this->first_name} {$this->last_name}"
        );
    }
}
