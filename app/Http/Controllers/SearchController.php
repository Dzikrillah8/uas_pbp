<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Genre;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index() {

        $stories = Story::where('visibility', 'public')->orderBy('created_at', 'desc')
        ->search(request(['search']))->genre(request(['genre']))->status(request(['status']))
        ->get();

        $genres = Genre::all();

        $user = auth()->user();
        
        return view('search', compact('stories', 'genres', 'user'));    
    }

    public function show() {
        
    }
}
