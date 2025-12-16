<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Genre;
use App\Models\Chapter;
use App\Models\Bookmark;
use App\Models\User;

class StoryAllController extends Controller
{
    public function index() {
        $stories = Story::where('visibility', 'public')->latest()->paginate(10);

        return view('index', compact('stories'));
    }

    public function home() {
        $stories = Story::where('visibility', 'public')->latest()->limit(8)->get();

        $topStories = Story::with(['user', 'genre'])->withCount('likes')->where('visibility', 'public')
        ->orderBy('likes_count', 'desc')->take(4)->get();

        $topAuthors = User::withCount([
            'stories as total_likes' => function ($query) {
                $query->join('likes', 'stories.id', '=', 'likes.story_id');
            }
        ])->orderByDesc('total_likes')->take(3)->get();

        $genres  = Genre::all();

        $user = auth()->user();

        return view('home', compact('stories', 'genres', 'topStories', 'topAuthors', 'user' ));
    }

    public function detail(Story $story) {

        $userBookmarks = Bookmark::where('user_id', auth()->id())->get();

        $user = auth()->user();
        
        return view('detailcerita', compact('story', 'userBookmarks', 'user'));

    }

    public function baca(Story $story) {
        abort_if($story->visibility !== 'public', 404);

        $chapter = $story->chapters()->where('visibility', 'public')
        ->with(['comments.user'])->orderBy('urutan')->first();

        $nextChapter = $story->chapters()
        ->where('visibility', 'public')
        ->where('urutan', '>', 1)
        ->orderBy('urutan')->first();

        $prevChapter = null;

        $user = auth()->user();

        return view('baca', compact('story', 'chapter', 'nextChapter', 'prevChapter', 'user'));
    }

    public function chapter(Story $story, Chapter $chapter) {
    
        abort_if(
            $chapter->story_id !== $story->id ||
            $story->visibility !== 'public' ||
            $chapter->visibility !== 'public',
            404
        );

        $chapter->load(['comments.user']);

        $nextChapter = Chapter::where('story_id', $story->id)
            ->where('visibility', 'public')
            ->where('urutan', '>', $chapter->urutan)
            ->orderBy('urutan')->first();

        $prevChapter = Chapter::where('story_id', $story->id)
            ->where('visibility', 'public')
            ->where('urutan', '<', $chapter->urutan)
            ->orderByDesc('urutan')->first();

        $user = auth()->user();

        return view('bacachap', compact(
            'story',
            'chapter',
            'nextChapter',
            'prevChapter',
            'user'
        ));
    }
}
