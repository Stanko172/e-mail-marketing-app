<?php

declare(strict_types=1);

namespace App\UI;

use App\Enums\ToastNotificationVariant;
use Illuminate\Contracts\Support\Arrayable;

final class ToastNotification implements Arrayable
{
    private function __construct(
        private string $message,
        private ToastNotificationVariant $variant,
        private int $closesAfter = 5000,
    ) {
    }

    public static function make(string $message, ToastNotificationVariant $variant): self
    {
        return new self($message, $variant);
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'variant' => $this->variant,
            'closesAfter' => $this->closesAfter,
        ];
    }
}
