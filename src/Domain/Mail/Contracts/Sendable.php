<?php

declare(strict_types=1);

namespace Domain\Mail\Contracts;

interface Sendable
{
    public function id(): int;

    public function subject(): string;

    public function content(): string;

    public function type(): string;
}
