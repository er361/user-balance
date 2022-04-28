<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountOperation extends Model
{
    use HasFactory;

    const TYPE_INCREMENT = 'increment';
    const TYPE_DECREMNT  = 'decrement';

    public $timestamps = false;

    public static function booted()
    {
        static::saving(fn(AccountOperation $operation) => $operation->executed_at = now());
    }
}
