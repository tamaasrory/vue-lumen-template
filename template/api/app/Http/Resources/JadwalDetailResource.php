<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JadwalDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var \App\Models\JadwalDetail $this */
        return [
            'text' => $this->vkelas->nama . ', ' . $this->vguru->nama,
            'guru' => $this->vguru->nama,
            'kelas' => //'Kelas ' .
            $this->vkelas->nama,
            'value' => $this->kode,
        ];
    }
}
