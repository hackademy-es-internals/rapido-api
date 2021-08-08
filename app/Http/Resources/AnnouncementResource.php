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
        $user = $this->whenLoaded('user');
        
        return [
            'title' => $this->title,
            'body' => $this->body,
            'price' => $this->price,
            'category' => $category->name,
            'user' => $user->name,
            'links' => [
                'self' => route('announcements.show',$this->id),
                'uri' => route('announcements.index'),
                'category' => route('categories.show',$category->id)
            ]
        ];
    }
}
