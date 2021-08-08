<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // public static $wrap = 'announcement';

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'price' => $this->price,
            // 'category' => new CategoryResource($this->category),
            'category' => route('categories.show',$this->category->id),
            'announcements-by-category' => route('annoucements.byCategory',$this->category->id),
        ];
    }
}
