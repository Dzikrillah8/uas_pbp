<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StoryAllController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Models\Genre;
use App\Models\User;
use App\Models\Story;
use App\Models\Bookmark;
use App\Models\Like;

use Illuminate\Support\Facades\Route;

Route::get('/', [StoryAllController::class, 'index'])->name('index');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');

Route::get('/home', [StoryAllController::class, 'home'])->name('home')->middleware('auth');
Route::get('/detail/{story:slug}', [StoryAllController::class, 'detail'])->middleware('auth');
Route::get('/baca/{story:slug}', [StoryAllController::class, 'baca'])->name('baca');
Route::get('/baca/{story:slug}/{chapter:slug}', [StoryAllController::class, 'chapter'])->name('baca.chapter');

Route::get('/perpus/checkSlug', [BookmarkController::class, 'checkSlug']);
Route::get('/perpus', [BookmarkController::class, 'index'])->middleware('auth');
Route::get('/perpus/create', [BookmarkController::class, 'create']);
Route::post('/perpus', [BookmarkController::class, 'store']);
Route::get('/perpus/{bookmark:slug}/edit', [BookmarkController::class, 'edit']);
Route::put('/perpus/{bookmark:slug}', [BookmarkController::class, 'update']);
Route::delete('/perpus/{bookmark:slug}', [BookmarkController::class, 'destroy']);
Route::get('/perpus/{bookmark:slug}', [BookmarkController::class, 'show']);
Route::post('/bookmark/{bookmark:slug}/add-story', [BookmarkController::class, 'addStory'])->middleware('auth');

Route::get('/story/checkSlug', [StoryController::class, 'checkSlug']);
Route::get('/mystory', [StoryController::class, 'index'])->middleware('auth');
Route::get('/story/{story:slug}/lanjut', [StoryController::class, 'lanjut']);
Route::resource('story', StoryController::class)->middleware('auth');

Route::get('stories/{story}/chapters/check-slug', [ChapterController::class, 'checkSlug'])->name('stories.chapters.checkSlug');
Route::get('/story/{story:slug}/lanjut', [ChapterController::class, 'lanjut'])->name('lanjutmenulis');
Route::delete('/stories/{story}/chapters/{chapter}', [ChapterController::class, 'destroy'])->name('chapters.destroy');
Route::resource('stories.chapters', ChapterController::class);

Route::post('/stories/{story:slug}/like', [LikeController::class, 'like'])->middleware('auth');

Route::get('/search', [SearchController::class, 'index'])->middleware('auth');

Route::post('/chapter/{chapter:slug}/comment', [CommentController::class, 'store'])->name('chapter.comment')->middleware('auth');

Route::get('/myprofile', [ProfileController::class, 'profile'])->middleware('auth');
Route::post('/myprofile/photo', [ProfileController::class, 'addPhoto'])->name('profile.addPhoto');
Route::get('/myprofile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/myprofile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/authors/{user}', [ProfileController::class, 'showProfile']);

Route::get('/genres', function() {
    $genres = Genre::with('stories')->get();

    return view('genre', [
        'title' => 'Story Genres',
        'genres' => $genres
    ]);
});

Route::get('/genre/{genre:slug}', function(Genre $genre) {
    $stories = $genre->stories()->latest()->get();
    $user = auth()->user();
    return view('genre', [
        'title' => $genre->name,
        'stories' => $stories,
        'genre' => $genre->name,
        'user' => $user
    ]);
});

// Route::get('/authors/{user}', function(User $user){
//     return view('otherprofile', [
//         'title' => 'User Profile',
//         'stories' => $user->stories
//     ]);
// });



