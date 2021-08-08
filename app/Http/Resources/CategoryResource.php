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
        return [
            'name'=>$this->name,
            'links' => [
                'self' => route('categories.show',$this->id),
                'uri' => route('categories.index'),
                'announcements' => route('announcements.byCategory',$this->id)
            ]
        ];
    }
}
