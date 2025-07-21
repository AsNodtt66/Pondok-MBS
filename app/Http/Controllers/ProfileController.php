<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:Pengguna');
        $this->middleware('role:santri');
    }

    public function showProfile()
    {
        $user = Auth::guard('Pengguna')->user();
        $santri = Santri::with('wali')->findOrFail($user->santri_id);

        Log::info('Profil Santri Debug', [
            'user_id' => $user->id,
            'username' => $user->username,
            'santri_id' => $user->santri_id,
            'santri_wali_id' => $santri->Wali_id,
            'santri_wali_data' => $santri->wali ? $santri->wali->toArray() : 'null'
        ]);
        if (is_null($santri->Wali_id)) {
            Log::warning('Wali ID null untuk santri_id: ' . $santri->id);
        }

        return view('dashboard.profil', compact('santri'));
    }

    public function updateProfilePicture(Request $request)
    {
        $user = Auth::guard('Pengguna')->user();
        $santri = Santri::findOrFail($user->santri_id);

        Log::info('Attempting to update profile picture', [
            'user_id' => $user->id,
            'santri_id' => $user->santri_id,
            'file_received' => $request->hasFile('foto_profil'),
            'file_name' => $request->hasFile('foto_profil') ? $request->file('foto_profil')->getClientOriginalName() : null,
            'storage_path' => storage_path('app/public/profil')
        ]);

        $validator = Validator::make($request->all(), [
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed for profile picture update', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            if ($santri->foto_profil) {
                Log::info('Deleting old profile picture', ['path' => $santri->foto_profil]);
                Storage::disk('public')->delete($santri->foto_profil);
            }

            $path = $request->file('foto_profil')->store('profil', 'public');
            $santri->foto_profil = $path;
            $santri->save();

            Log::info('Profile picture updated successfully', [
                'path' => $path,
                'url' => asset('storage/' . $path)
            ]);
            return redirect()->back()->with('success', 'Foto profil berhasil diganti, bro!');
        } catch (\Exception $e) {
            Log::error('Error updating profile picture', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withErrors(['error' => 'Gagal ganti foto profil: ' . $e->getMessage()]);
        }
    }

    public function deleteProfilePicture()
    {
        $user = Auth::guard('Pengguna')->user();
        $santri = Santri::findOrFail($user->santri_id);

        Log::info('Attempting to delete profile picture', [
            'user_id' => $user->id,
            'santri_id' => $user->santri_id,
            'foto_profil' => $santri->foto_profil
        ]);

        try {
            if ($santri->foto_profil) {
                Storage::disk('public')->delete($santri->foto_profil);
                $santri->foto_profil = null;
                $santri->save();

                Log::info('Profile picture deleted successfully');
                return redirect()->back()->with('success', 'Foto profil berhasil dihapus, bro!');
            }

            Log::warning('No profile picture to delete', ['santri_id' => $santri->id]);
            return redirect()->back()->withErrors(['error' => 'Gak ada foto profil buat dihapus, bro!']);
        } catch (\Exception $e) {
            Log::error('Error deleting profile picture', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withErrors(['error' => 'Gagal hapus foto profil: ' . $e->getMessage()]);
        }
    }
}