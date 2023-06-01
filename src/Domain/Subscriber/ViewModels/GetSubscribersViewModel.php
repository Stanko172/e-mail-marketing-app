<?php

declare(strict_types=1);

namespace Domain\Subscriber\ViewModels;

use Domain\Subscriber\DataTransferObjects\SubscriberData;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Spatie\TypeScriptTransformer\Attributes\TypeScriptType;
use Spatie\ViewModels\ViewModel;

#[TypeScript]
class GetSubscribersViewModel extends ViewModel
{
    private const PER_PAGE = 5;

    public function __construct(
        private readonly int $currentPage,
    ) {
    }

    #[TypeScriptType([
        'current_page' => 'int',
        'data' => 'array<'.SubscriberData::class.'>',
        'first_page_url' => 'string',
        'from' => 'int',
        'next_page_url' => 'string|null',
        'path' => 'string',
        'per_page' => 'int',
        'prev_page_url' => 'string|null',
        'to' => 'int',
    ])]
    public function subscribers(): Paginator
    {
        /** @var Collection $items */
        $items = Subscriber::with(['form', 'tags'])
            ->orderBy('first_name')
            ->get()
            ->map(function (Subscriber $subscriber) {
                return SubscriberData::from($subscriber);
            });

        $items = $items->slice(
            self::PER_PAGE * ($this->currentPage - 1)
        );

        return new Paginator(
            $items->values(),
            self::PER_PAGE,
            $this->currentPage,
            [
                'path' => route('subscribers.index'),
            ],
        );
    }

    public function total(): int
    {
        return Subscriber::count();
    }
}
