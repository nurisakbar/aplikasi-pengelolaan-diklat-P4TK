<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JumlahDiklatPertahunResource extends JsonResource
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
            'tahun' => $this->tahun,
            'jumlah_peserta' => $this->jumlah_peserta,
        ];
    }
}
