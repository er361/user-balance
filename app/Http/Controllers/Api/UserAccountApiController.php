<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperationsListRequest;
use App\Http\Resources\AccountOperationsResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserAccountApiController extends Controller
{
    public function getUserAccountLastFiveOperations(): AnonymousResourceCollection
    {
        $operations = \Auth::user()
            ->account?->operations()
            ->orderByDesc('executed_at')
            ->limit(5)
            ->get();

        return AccountOperationsResource::collection($operations);
    }

    public function getUserAccountOperations(OperationsListRequest $request)
    {
        $search = $request->input('search');
        $operations = \Auth::user()
            ->account?->operations()
            ->orderBy('executed_at', $request->input('sortOrder', 'desc'))
            ->when(
                $search,
                fn(Builder $query) => $query->where('reason', 'like', '%' . $search . '%')
            )
            ->get();
        return AccountOperationsResource::collection($operations);
    }
}
