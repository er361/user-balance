<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class UserAccountApiController extends Controller
{
    public function getUserAccountLastFiveOperations(): ?Collection
    {
        return \Auth::user()
            ->account?->operations()
            ->orderByDesc('executed_at')
            ->limit(5)
            ->get();
    }

    public function getUserAccountOperations()
    {
    }
}
