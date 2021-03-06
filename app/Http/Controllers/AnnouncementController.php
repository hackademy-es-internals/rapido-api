<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\AnnouncementResource;
use App\Http\Resources\AnnouncementCollection;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // with(): lazy loading during a query
        return new AnnouncementCollection(Announcement::with(['category','user'])->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::getAuthenticated(); 
        
        $category = Category::findOrFail($request->category_id);
            
        $announcement = $category->announcements()->create($request->all());
        $announcement->user()->associate($user);
        $announcement->save();
        // loadmissing when model instance already exists
        // https://laravel.com/docs/8.x/eloquent-collections#method-loadMissing
        return new AnnouncementResource($announcement->loadMissing(['category','user']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        return new AnnouncementResource($announcement->loadMissing(['category','user']));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        if($announcement->update($request->all()))
            return new AnnouncementResource($announcement);
        
        return response()->json(['message' => 'Error'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        if($announcement->delete())
            return response()->json(['message' => 'Accepted'],200);
        
        return response()->json(['message' => 'Error'],500);
        
    
    }

    public function byCategory(Category $category)
    {
        return new AnnouncementCollection($category->announcements->loadMissing(['category','user']));
    }

    public function byUser(User $user)
    {
        return new AnnouncementCollection($user->announcements->loadMissing(['category','user']));
    }
}
