<?php

declare(strict_types=1);

namespace Domain\Mail\Contracts;

interface Sendable
{
    public function id(): string;
    public function type(): string;
}
