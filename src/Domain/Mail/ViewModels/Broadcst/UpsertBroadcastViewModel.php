<?php

namespace Domain\Mail\ViewModels\Broadcast;

use Domain\Mail\DataTransferObjects\Broadcasts\BroadcastData;
use Domain\Mail\Models\Broadcast\Broadcast;
use Domain\Shared\ViewModels\Concerns\HasForms;
use Domain\Shared\ViewModels\Concerns\HasTags;
use Domain\Shared\ViewModels\ViewModel;

class UpsertBroadcastViewModel extends ViewModel
{
    use HasTags;
    use HasForms;

    public function __construct(
        public readonly ?Broadcast $broadcast = null,
    ) {
    }

    public function broadcast(): ?BroadcastData
    {
        return $this->broadcast
              ? BroadcastData::from($this->broadcast)
              : null;
    }
}
