<?php

namespace App\Http\Resources\OrderHeaderResources;

use App\Enums\OrderStateEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderHeaderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ref_service' => $this->ref_service,
            'state' => $this->state->all,
            'phone_number' => $this->phone_number,
            'pick_up_date' => $this->pick_up_date,
            'delivery_date' => $this->delivery_date,
            'pick_up_address' => $this->pick_up_address,
            'delivery_address' => $this->delivery_address,
            'total_ht' => $this->total_ht,
            'total_tva' => $this->total_tva,
            'total_ttc' => $this->total_ttc,
            'total_discount' => $this->total_discount,
            'delivery_cost' => $this->delivery_cost,
            'net_to_pay' => $this->net_to_pay,
            'note' => $this->note,
            'order_lines' => $this->order_lines,
        ];
    }
}
