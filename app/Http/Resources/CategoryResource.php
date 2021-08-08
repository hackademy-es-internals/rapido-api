<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AnnouncementCollection;


class CategoryResource extends JsonResource
{
    // public static $wrap = 'category';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {  
        $announcements = $this->whenLoaded('announcements');
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            // 'announcements'=> new AnnouncementCollection($announcements), 
            'announcements-by-category'=>route('announcements.byCategory',$this->id),
            'self' => route('categories.show',$this->id)
        ];
    }
}
