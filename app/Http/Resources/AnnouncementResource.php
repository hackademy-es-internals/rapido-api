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
        $category = $this->whenLoaded('category');
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'price' => $this->price,
            // 'category' => new CategoryResource($category),
            'category-detail' => route('categories.show',$category->id),
            'self' => route('announcements.show',$this->id)
        ];
    }
}
