<?php

namespace App\Http\Controllers;

use App\Enums\ToastNotificationVariant;
use App\UI\ToastNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function toast(string $message, ToastNotificationVariant $variant = ToastNotificationVariant::Success): self
    {
        session()->flash('toastNotifications', [
            ToastNotification::make($message, $variant),
        ]);

        return $this;
    }
}
