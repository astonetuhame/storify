<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Story;
use App\Events\StoryCreated;
use Illuminate\Http\Request;
use App\Mail\NewStoryNotification;
use App\Http\Requests\StoryRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

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
            ->with('tags')
            ->orderBy('id', 'DESC')
            ->paginate(10);
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
        $tags = Tag::get();

        return view('stories.create', [
            'story' => $story,
            'tags' => $tags
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

        $story = auth()->user()->stories()->create($request->all());

        // Mail::send(new NewStoryNotification($story->title));

        // Log::info('A story with title' . $story->title . 'was added');

        if ($request->hasFile('image')) {
            $this->_uploadImage($request, $story);
        }

        $story->tags()->sync($request->tag);

        Event(new StoryCreated($story->title));
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
        $tags = Tag::get();
        return view('stories.edit', [
            'story' => $story,
            'tags' => $tags
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
        $story->update($request->all());
        if ($request->hasFile('image')) {
            $this->_uploadImage($request, $story);
        }

        $story->tags()->sync($request->tag);

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

    private function _uploadImage($request, $story)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(25, 100)->save(public_path('storage/' . $filename));
            $story->image = $filename;
            $story->save();
        }
    }
}
