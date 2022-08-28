<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CopounResource extends JsonResource
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
            'id'=>$this->id,
            'code'=>$this->code,
            'discount'=>$this->discount,
            'type'=>$this->type,
            'is_unlimited'=>$this->is_unlimit,
            'the_number_of_times_allowed'=>$this->num_use,
            'number_of_use'=>$this->use_count,
            'start_at'=>$this->start_at,
            'end_at'=>$this->end_at,
            'status'=>$this->status
        ];
    }
}
