<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperationsListRequest;
use App\Http\Resources\AccountOperationsResource;
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
        $operations = \Auth::user()
            ->account?->operations()
            ->orderBy('executed_at', $request->input('sortOrder', 'desc'))
            ->get();

        return AccountOperationsResource::collection($operations);
    }
}
