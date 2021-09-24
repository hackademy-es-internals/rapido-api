<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Http\Resources\UserResource;
use App\Models\User;
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
        // https://laravel.com/docs/8.x/eloquent-resources#conditional-relationships
        $category = $this->whenLoaded('category');
        $user = $this->whenLoaded('user');
        return [
            'title' => $this->title,
            'body' => $this->body,
            'price' => $this->price,
            'user' => new UserResource($user),
            'category' => new CategoryResource($category),
            'links' => [
                'self' => route('announcements.show',$this->id),
                'uri' => route('announcements.index'),
                'category' => $category instanceof Category ? route('categories.show',$category->id) : "",
                'user' => $user instanceof User ? route('users.show',$user->id) : ""
            ]
        ];
    }
}
