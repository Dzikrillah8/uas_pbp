<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\User;

use App\Models\Chapter;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Chapter $chapter)
    {

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'chapter_id' => $chapter->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil dikirim!');
    }
}
