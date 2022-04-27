<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
    ];

    public function getBalanceAttribute($value): float
    {
        return $value / 100;
    }

    public function setBalanceAttribute(int $value)
    {
        $this->attributes['balance'] = $value * 100;
    }

    public function operations(): HasMany
    {
        return $this->hasMany(AccountOperation::class, 'account_id');
    }
}
