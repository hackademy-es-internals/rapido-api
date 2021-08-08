<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'links' => [
                'self' => route('users.show',$this->id),
                'uri' => route('users.index'),
                'annoucements' => route('announcements.byUser',$this->id)
            ]
        ];
    }
}
