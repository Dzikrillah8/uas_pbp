<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Pic;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile() {

        return view('myprofile', [
            'user' => Auth::user()
        ]);
    }

    public function showProfile(User $user) {
        return view('otherprofile', [
            'title' => $user->name,
            'user' => $user,
            'stories' => $user->stories
        ]);
    }

    public function addPhoto(Request $request) {
        $user = Auth::user();

        $request->validate([
            'pic_path' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($user->pic) {
            Storage::disk('public')->delete($user->pic->pic_path);
            $user->pic->delete();
        }

        $file = $request->file('pic_path')->store('profile', 'public');

        Pic::create([
            'user_id' => $user->id,
            'pic_path' => $file
        ]);

        return redirect()->back()->with('success', 'Foto profil berhasil ditambahkan!');
    }

    public function edit() {
        return view('editprofile', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request) {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'nullable|not_regex:/@/|max:225',
            'username' => 'nullable|min:3|max:255|unique:users,username,' . $user->id,
            'bio' => 'nullable|string',
            'email' => 'nullable|email:dns|unique:users,email,' . $user->id,
            'pic_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Update data user
        $user->update([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'bio' => $validatedData['bio'] ?? null
        ]);

        $oldPic = $user->pic;

        if ($request->hasFile('pic_path')) {
            $file = $request->file('pic_path')->store('profile', 'public');

            if ($oldPic) {
                Storage::disk('public')->delete($oldPic->pic_path);
                $oldPic->delete();
            }

            Pic::create([
                'user_id' => $user->id,
                'pic_path' => $file,
            ]);

            $user->refresh();
        }

        return redirect('/myprofile')->with('success', 'Profil berhasil diperbarui');
    }

}

