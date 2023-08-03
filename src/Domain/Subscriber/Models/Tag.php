<?php

declare(strict_types=1);

namespace Domain\Subscriber\Models;

use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\Concerns\HasUser;

class Tag extends BaseModel
{
    use HasUser;
    protected $fillable = [
        'title',
        'user_id',
    ];
}
