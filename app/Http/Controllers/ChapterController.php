<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Story;
use App\Models\Chapter;
use App\Models\Genre;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use \Cviebrock\EloquentSluggable\Services\SlugService;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Story $story)
    {
        // $chapters = $story->chapters()->orderBy('urutan')->get();
        // return view('chapter.index', compact('story', 'chapters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Story $story)
    {
        return view('tulischapter', [
            'story' => $story, 
            'slug' => $story->slug
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Story $story)
    {
        $nextUrutan = ($story->chapters()->max('urutan') ?? 0) + 1;

        $validatedData = $request->validate([
            'chap_title' => 'required|max:255',
            'slug' => ['required',
                Rule::unique('chapters')->where(function ($query) use ($story) {
                return $query->where('story_id', $story->id);
                }),
            ],
            'visibility' => 'required|in:draft,public',
            'content' => 'required'
        ]);

        $validatedData['urutan']   = $nextUrutan;
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['story_id'] = $story->id;

        Chapter::create($validatedData);

        return redirect('/mystory')->with('chap_created', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Story $story, $chapterSlug)
    {
        $chapter = Chapter::where('story_id', $story->id)->where('slug', $chapterSlug)->firstOrFail();

        return view('editchapter', [
            'story' => $story,
            'chapter' => $chapter
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Story $story, Chapter $chapter)
    {
        $request->validate([
            'chap_title' => 'required|max:255',
            'slug' => ['required',
                Rule::unique('chapters')->ignore($chapter->id)->where(fn($q) => $q->where('story_id', $story->id)),
            ],
            'content' => 'required',
            'visibility' => 'required|in:draft,public'
        ]);

        $chapter->update([
            'chap_title' => $request->chap_title,
            'slug' => $request->slug,
            'content' => $request->content,
            'visibility' => $request->visibility,
        ]);

        return redirect()->route('lanjutmenulis', $story)->with('story_edited', true);
    }

    public function lanjut(Story $story) {
        return view('lanjutmenulis', [
            'story' => $story,
            'chapters' => $story->chapters()->orderBy('urutan')->get(),
            'genres' => Genre::all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Story $story, Chapter $chapter)
    {
        // $chapter->delete();
        Chapter::destroy($chapter->id);

        return redirect()->route('lanjutmenulis', $story)->with('chap_deleted', true);
    }

    public function checkSlug(Request $request, Story $story)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $baseSlug = Str::slug($request->title);
        $slug = $baseSlug;
        $count = 1;

        // check slug only this story's chap
        while (
            Chapter::where('story_id', $story->id)
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $count++;
        }

        return response()->json([
            'slug' => $slug
        ]);
    }
}
