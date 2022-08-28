<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Auth::user()->profile;
        $tags = Tag::all();
        return view('profile', compact('profile', 'tags'));
    }

    public function show($id)
    {
        $profile = User::find($id);
        $madings = $profile->madings()->orderBy('updated_at', 'desc')->paginate(5);
        $tags = Tag::all();
        $isProfile = true;
        $popular_tag = $tags = Tag::with('madings')->get()->sortBy(function ($hackathon) {
            return $hackathon->madings->count();
        }, SORT_REGULAR, true)->slice(0, 3);
        return view('home', compact('madings', 'popular_tag', 'isProfile', 'tags', 'profile'));
    }

    public function update(Request $request)
    {

        $profile = Auth::user()->profile;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'regex:/(^[a-zA-Z]+[a-zA-Z0-9\\-]*$)/u', 'max:255', 'unique:users'],
            'tanggal_lahir' => ['required', 'date'],
        ]);

        $profile->update([
            'bio' => $request->bio,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        if ($request->has('foto-profile')) {
            $foto_mading = $request->file('foto-profile');
            $nama_file = time() . '.' . $foto_mading->getClientOriginalExtension();
            $foto_mading->move(public_path('images'), $nama_file);
            $profile->update([
                'foto_profile' => $nama_file,
            ]);
        }

        $profile->user->update([
            'name' => $request->name,
            'username' => $request->username,
        ]);

        Session::flash('success', 'Profile berhasil diperbarui');
        return redirect()->back();
    }
}
