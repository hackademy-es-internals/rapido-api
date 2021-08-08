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
        return new AnnouncementCollection(Announcement::with(['category','user'])->paginate(2));
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
        
        if($category = Category::findOrFail($request->category_id)){
            $announcement = $category->announcements()->create($request->all());
            $announcement->user()->associate($user);
            $announcement->save();
            return new AnnouncementResource($announcement->loadMissing(['category','user']));
        }
        // return response()->json('created',201);
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
        
        return response()->json(['message' => 'Error'], 400);
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
            return response()->json('success',200);
    
    }

    public function byCategory(Category $category)
    {
        return new AnnouncementCollection($category->announcements);
    }
}
