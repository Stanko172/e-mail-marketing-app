<?php

namespace Domain\Subscriber\Actions;

use Domain\Mail\Contracts\Sendable;
use Domain\Mail\Models\Sequence\SequenceMail;
use Domain\Subscriber\Enums\Filters;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Collection;

class FilterSubscribersAction
{
    public static function execute(Sendable $mail): Collection
    {
        $subscribers = Subscriber::query();

        if ($mail instanceof SequenceMail) {
            $subscribers = Subscriber::query()
                ->whereIn(
                    'id',
                    $mail->sequence->subscribers()
                        ->select('subscribers.id')->pluck('id')
                );
        }

        return app(Pipeline::class)
            ->send($subscribers)
            ->through(self::filters($mail))
            ->thenReturn()
            ->get();
    }

    public static function filters(Sendable $mail): array
    {
        return collect($mail->filters()->toArray())
            ->map(
                fn (array $ids, string $key) => Filters::from($key)->createFilter($ids)
            )
            ->values()
            ->all();
    }
}
