<?php

declare(strict_types=1);

namespace Domain\Subscriber\Models;

use Domain\Shared\Models\BaseModel;

class Tag extends BaseModel
{
    protected $fillable = [
        'title',
        'user_id',
    ];
}
