<?php

namespace App\Http\Controllers\Layouts;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        return view('layouts.profil', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Validasi input (nama dan email opsional)
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'nullable|string|min:8|confirmed',
            'name' => 'nullable|string|max:255', // Nama opsional
            'email' => 'nullable|email|max:255|unique:users,email,' . Auth::id(), // Email opsional, harus unik
            'foto' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // Verifikasi password saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        // Update password baru (jika ada)
        if (!empty($request->new_password)) {
            $user->password = Hash::make($request->new_password);
        }

        // Update nama (jika diisi)
        if (!empty($request->name)) {
            $user->name = $request->name;
        }

        // Update email (jika diisi)
        if (!empty($request->email)) {
            $user->email = $request->email;
        }

        // Update foto profil (jika ada)
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                Storage::delete('public/management_user/foto_profil/' . $user->foto);
            }

            // Simpan foto baru
            $file = $request->file('foto');
            $fileName = $file->hashName();
            $file->storeAs('public/management_user/foto_profil', $fileName);
            $user->foto = $fileName;
        }

        $user->save();

        return redirect()->back()->with('status', 'Profil Berhasil Diperbarui');
    }
}
