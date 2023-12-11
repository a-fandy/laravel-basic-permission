<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    public const ACTIVE = true;

    public const EXCLUDE_INPUT = [
        'password' => '',
    ];

    public const EXCLUDE_URL = [
        '/',
    ];
}
