<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCharterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'service'=>$this->service,
            'requirements'=>$this->requirements,
            'cost'=>$this->cost,
            'timeline'=>$this->timeline,
            'scinstitution_id'=>$this->scinstitution_id,
            'scinstitution'=>$this->scinstitution,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
