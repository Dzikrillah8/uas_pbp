<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Genre;
use App\Models\Chapter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stories = Story::where('user_id', auth()->id())
        ->withCount([
            'chapters as public_chap_count' => function ($query) {
                $query->where('visibility', 'public');
            },
            'chapters as draft_chap_count' => function ($query) {
                $query->where('visibility', 'draft');
            },
        ])
        ->latest()
        ->get();

        $user = auth()->user();

        return view('ceritasaya', compact('stories', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buatcerita', [
            'genres' => Genre::all(),
            'stories' => Story::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:stories',
            'genre_id' => 'required',
            'visibility' => 'required|in:public,draft',
            'cover' => 'image|file|max:1024',
            'sinopsis' => 'required'
        ]);

        if ($request->file('cover')) {
            $validatedData['cover'] = $request->file('cover')->store('story-covers');
        }

        $validatedData['user_id'] = auth()->user()->id;

        $story = Story::create($validatedData);

        return redirect()->route('stories.chapters.create', ['story' => $story->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Story $story)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function lanjut(Story $story) {
        return view('lanjutmenulis', [
            'story' => $story,
            'chapters' => $story->chapters()->orderBy('urutan')->get(),
            'genres' => Genre::all()
        ]);
    }

    public function edit(Story $story)
    {
        return view('editcerita', [
            'story' => $story,
            'genres' => Genre::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Story $story)
    {
       $rules = [
            'title' => 'required|max:255',
            'genre_id' => 'required',
            'cover' => 'image|file|max:1024',
            'sinopsis' => 'required',
            'visibility' => 'required|in:public,draft',
        ];

        if ($request->slug != $story->slug) {
            $rules['slug'] = 'required|unique:stories';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('cover')) {
            if($request->oldCover) {
                Storage::delete($request->oldCover);
            }
            $validatedData['cover'] = $request->file('cover')->store('story-covers');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Story::where('id', $story->id)
        ->update($validatedData);

        return redirect('/mystory')->with('story_edited', true);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Story $story)
    {
        if($story->cover) {
            Storage::delete($story->cover);
        }

        Story::destroy($story->id);
        return redirect('/mystory')->with('deleted', true);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Story::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
