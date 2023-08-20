<?php

declare(strict_types=1);

namespace App\Enums;

enum ToastNotificationVariant: string
{
    case Critical = 'critical';
    case Info = 'info';
    case Success = 'success';
    case Warning = 'warning';
}
