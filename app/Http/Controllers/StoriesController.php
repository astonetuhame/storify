<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use App\Http\Requests\StoryRequest;
use Illuminate\Support\Facades\Gate;

class StoriesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Story::class, 'story');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stories = Story::where('user_id', auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(3);
        return view('stories.index', [
            'stories' => $stories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $story = new Story;
        return view('stories.create', [
            'story' => $story
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {
        //
        auth()->user()->stories()->create( $request->all());

        return redirect()->route('stories.index')->with('status', 'Story Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        //
        return view('stories.show', [
            'story' => $story
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        // Gate::authorize('edit-story', $story);
        // $this->authorize('update', $story);
        return view('stories.edit', [
            'story' => $story
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(StoryRequest $request, Story $story)
    {
        //
        $story->update( $request->all() );

        return redirect()->route('stories.index')->with('status', 'Story Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        //
        $story->delete();
        return redirect()->route('stories.index')->with('status', 'Story Deleted Successfully!');

    }
}
