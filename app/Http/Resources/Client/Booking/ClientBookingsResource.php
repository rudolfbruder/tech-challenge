<?php

namespace App\Http\Resources\Client\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientBookingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'time' => $this->time,
            'start' => $this->start,
            'end' => $this->end,
            'notes' => $this->notes,
            'client_id' => $this->client_id,
        ];
        return parent::toArray($request);
    }
}
