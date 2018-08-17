<?php

namespace Onetoefoot\Sampleidentifier\Controllers\Api;

use Onetoefoot\Sampleidentifier\Models\SiRecord;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SiRecordCollection extends ResourceCollection
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
            'data' => SiRecordResource::collection($this->collection),
        ];
    }
}
