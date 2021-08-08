<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnnouncementCollection;
use App\Http\Resources\AnnouncementResource;
use App\Models\Announcement;
use App\Models\Category;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new AnnouncementCollection(Announcement::with('category')->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($category = Category::findOrFail($request->category_id))
            return new AnnouncementResource($category->announcements()->create($request->all()));
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
        return new AnnouncementResource($announcement->loadMissing('category'));
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

    public function getByCategory(Category $category)
    {
        return new AnnouncementCollection($category->announcements);
    }
}
