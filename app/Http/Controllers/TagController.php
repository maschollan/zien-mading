<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::with('madings')->get()->sortBy(function ($hackathon) {
            return $hackathon->madings->count();
        }, SORT_REGULAR, true);
        return view('tag', compact('tags'));
    }

    public function show(Tag $tag)
    {
        $madings = $tag->madings()->orderBy('updated_at', 'desc')->paginate(5);
        $selected_tag = $tag->nama;
        $tags = Tag::all();
        $isTag = true;
        $popular_tag = $tags = Tag::with('madings')->get()->sortBy(function ($hackathon) {
            return $hackathon->madings->count();
        }, SORT_REGULAR, true)->slice(0, 3);
        return view('home', compact('madings', 'isTag', 'selected_tag', 'popular_tag', 'tags'));
    }
}
 