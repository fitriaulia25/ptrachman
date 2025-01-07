<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Agenda;
use App\Models\Atensi;
use Carbon\Carbon;

class SuperAdminController extends Controller
{
    public function index()
    {
        // Ambil data agenda dan atensi untuk grafik
        $agendas = Agenda::all();
        $atensi = Atensi::all();

        // Mengambil data per bulan untuk grafik
        $agendaMonthlyCounts = $agendas->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m'); // Mengelompokkan berdasarkan tahun-bulan
        })->map->count();

        $atensiMonthlyCounts = $atensi->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m'); // Mengelompokkan berdasarkan tahun-bulan
        })->map->count();

        // Siapkan data untuk chart
        $agendaMonths = $agendaMonthlyCounts->keys()->toArray();
        $agendaCounts = $agendaMonthlyCounts->values()->toArray();

        $atensiMonths = $atensiMonthlyCounts->keys()->toArray();
        $atensiCounts = $atensiMonthlyCounts->values()->toArray();
        
        $latestAgendas = Agenda::orderBy('tanggal', 'desc')->take(5)->get(); // Call the method to get the latest agendas
        $latestAtensis = Atensi::orderBy('tanggal_waktu', 'desc')->take(5)->get();

        return view('super_admin.dashboard', compact('agendas', 'atensi', 'agendaMonths', 'agendaCounts', 'atensiMonths', 'atensiCounts','latestAgendas', 'latestAtensis'));
    }

    public function __construct()
    {
        $this->middleware('auth'); // Pastikan user sudah login
    }

    public function editProfile($id)
    {
        $user = User::findOrFail($id);
        return view('super_admin.edit', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'old_password' => 'nullable',
            'new_password' => 'nullable|min:8',
            'confirm_password' => 'same:new_password',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password
        if ($request->old_password && $request->new_password) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
            } else {
                return back()->withErrors(['old_password' => 'Old password is incorrect']);
            }
        }

        // Update foto profil
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete('public/' . $user->photo); // Hapus foto lama
            }
            $filePath = $request->file('photo')->store('profile_photos', 'public');
            $user->photo = $filePath;
        }

        $user->save();

        return redirect()->route('superadmin.profile.edit', $user->id)->with('success', 'Profile updated successfully!');
    }

    public function deletePhoto($id)
    {
        $user = User::findOrFail($id);

        // Hapus file foto dari storage jika ada
        if ($user->photo && \Storage::exists($user->photo)) {
            \Storage::delete($user->photo);
        }

        // Update kolom `photo` menjadi null
        $user->photo = null;
        $user->save();

        return redirect()->back()->with('success', 'Profile photo has been removed successfully!');
    }
    public function users()
    {
        $users = User::paginate(10); // Fetch users with pagination
        $agendas = Agenda::all(); // Make sure you fetch your agendas
        $atensi = Atensi::all(); // Fetch attentions if needed
        $users = User::paginate(10); // Fetch users if needed
        $hasSuperAdmin = User::where('role', 'superadmin')->exists();

         return view('super_admin.index', compact('users', 'agendas', 'atensi')); // Include agendas here
    }
    public function show($id, $type)
    {
        // Validasi type agar hanya menerima 'agenda' atau 'atensi'
        if (!in_array($type, ['agenda', 'atensi'])) {
            abort(404);
        }

        // Ambil data berdasarkan tipe
        $data = $type === 'agenda' ? Agenda::findOrFail($id) : Atensi::findOrFail($id);

        // Kirim data ke view
        return view('super_admin.show', compact('data', 'type'));
    }
    public function destroy($id)
{
    $user = User::findOrFail($id); // Cari pengguna berdasarkan ID
    if ($user->photo && Storage::exists('public/' . $user->photo)) {
        // Hapus foto profil jika ada
        Storage::delete('public/' . $user->photo);
    }
    $user->delete(); // Hapus pengguna dari database
    return redirect()->route('super_admin.users')->with('success', 'User account deleted successfully!');
}



}
