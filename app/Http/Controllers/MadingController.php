<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Mading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MadingController extends Controller
{
    public function index()
    {
        $madings = Mading::orderBy('updated_at', 'desc')->paginate(5);
        $popular_tag = $tags = Tag::with('madings')->get()->sortBy(function ($hackathon) {
            return $hackathon->madings->count();
        }, SORT_REGULAR, true)->slice(0, 3);
        $tags = Tag::all();
        return view('home', compact('madings', 'popular_tag', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'konten' => ['required', 'string', 'max:255'],
        ]);

        $mading = Mading::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'user_id' => Auth::id(),
        ]);

        if ($request->has('foto')) {
            $foto_mading = $request->file('foto');
            $nama_file = time() . '.' . $foto_mading->getClientOriginalExtension();
            $foto_mading->move(public_path('images'), $nama_file);
            $mading->foto_mading = $nama_file;
        }

        $mading->save();

        foreach ($request->tags as $tag) {
            $mading->tags()->attach($tag);
        }
        Session::flash('success', 'Mading berhasil ditambahkan');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'konten' => ['required', 'string', 'max:255'],
            // 'tag' => ['required', 'string', 'max:255'],
        ]);
        $mading = Mading::find($id);
        $mading->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
        ]);

        if ($request->has('foto')) {
            $foto_mading = $request->file('foto');
            $nama_file = time() . '.' . $foto_mading->getClientOriginalExtension();
            $foto_mading->move(public_path('images'), $nama_file);
            $mading->foto_mading = $nama_file;
        }

        $mading->updated_at = now();
        $mading->save();
        $mading->touch();

        $mading->tags()->detach();

        foreach ($request->tags as $tag) {
            $mading->tags()->attach($tag);
        }

        Session::flash('success', 'Mading berhasil diperbarui');
        return redirect()->back();
    }

    public function delete($id)
    {
        $mading = Mading::find($id);
        $mading->delete();
        Session::flash('success', 'Mading berhasil dihapus');
        return redirect()->back();
    }
}
