<?php

declare(strict_types=1);

namespace Domain\Subscriber\Models;

use Domain\Shared\Models\BaseModel;

class Form extends BaseModel
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];
}
