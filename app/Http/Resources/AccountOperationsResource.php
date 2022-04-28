<?php

namespace App\Http\Resources;

use App\Models\AccountOperation;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountOperationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'type'        => $this->type == AccountOperation::TYPE_DECREMNT ? 'Списание' : 'Начисление',
            'sum'         => $this->sum,
            'balance'     => $this->balance,
            'reason'      => $this->reason,
            'executed_at' => $this->executed_at,
        ];
    }
}
