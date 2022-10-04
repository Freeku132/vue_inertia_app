<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->when(Auth::user()->is($this->resource), $this->email),
            'created_at' => Carbon::createFromTimestamp($this->created_at)->toDateTimeString(),
            'can' => [
                'edit' => Auth::user()->can('edit', $this->resource)
            ]
        ];
    }
}
