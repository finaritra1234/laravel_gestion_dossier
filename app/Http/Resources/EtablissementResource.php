<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EtablissementResource extends JsonResource
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
            'cisco' => $this->cisco,
            'nom_etabl' => $this->nom_etabl,
            'adresse_etabl' => $this->adresse_etabl,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
