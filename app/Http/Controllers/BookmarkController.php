<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Story;
use App\Models\Isibookmark;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class BookmarkController extends Controller
{
    public function index() {
        $user = auth()->user();
        $bookmarks = Bookmark::where('user_id', auth()->id())->latest()->get();

        return view('perpus', compact('bookmarks', 'user'));
    }

    public function create() {
        return view('buatkoleksi', [
            'bookmark' => Bookmark::all()
        ]);
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:bookmarks',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        $bookmark = Bookmark::create($validatedData);

        return redirect('/perpus')->with('created', true);
    }

    public function edit(Bookmark $bookmark) {
        return view('editkoleksi', [
            'bookmark' => $bookmark
        ]);
    }

    public function update(Request $request, Bookmark $bookmark) {
        $rules = [
            'name' => 'required|max:255'
        ];

        if ($request->slug != $bookmark->slug) {
            $rules['slug'] = 'required|unique:bookmarks';
        }

        $validatedData = $request->validate($rules);
        $validatedData['user_id'] = auth()->user()->id;

        Bookmark::where('id', $bookmark->id)
        ->update($validatedData);

        return redirect('/perpus')->with('updated', true);
    }

    public function destroy(Bookmark $bookmark) {
        Bookmark::destroy($bookmark->id);

        return redirect('/perpus')->with('deleted', true);
    }

    public function show(Bookmark $bookmark) {
        $isibookmarks = $bookmark->isibookmarks()->latest()->get();

        $user = auth()->user();

        return view('isikoleksi', compact('bookmark', 'isibookmarks', 'user'));
    }

    public function addStory(Request $request, Bookmark $bookmark) {
        $request->validate([
        'story_id' => 'required|exists:stories,id',
        ]);

        $bookmark->isibookmarks()->create([
            'story_id' => $request->story_id
        ]);

        return back()->with('added', true);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Bookmark::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
