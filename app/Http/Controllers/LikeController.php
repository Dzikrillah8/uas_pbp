<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Like;

use Illuminate\Http\Request;

class LikeController extends Controller
{
        public function like(Story $story) {

            $like = Like::firstOrCreate([
                'user_id'  => auth()->id(),
                'story_id' => $story->id,
            ]);

            if (! $like->wasRecentlyCreated) {
                return redirect()->back()->with('alr_liked', true);
            }

            return redirect()->back()->with('liked', true);
        }

}
