<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atensi;
use Exception;
use Illuminate\Support\Facades\Storage; // Untuk operasi file

class AtensiController extends Controller
{
    // Menampilkan daftar atensi
    public function index(Request $request)
    {
        $query = Atensi::query();

        // Filter berdasarkan tanggal jika ada
        if ($request->filled('tanggal')) {
            // Gunakan whereDate untuk memfilter berdasarkan tanggal tanpa waktu
            $query->whereDate('tanggal_waktu', $request->tanggal);
        }

        // Ambil data yang sudah difilter berdasarkan tanggal
        $data = $query->orderBy('tanggal_waktu', 'desc')->get();

        return view('atensi.index', compact('data'));
    }

    // Menampilkan form untuk membuat atensi baru
    public function create()
    {
        return view('atensi.create');
    }

    // Menyimpan data atensi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_waktu' => 'required|date',
            'yth' => 'required|string',
            'kegiatan' => 'required|string',
            'pelaksanaan_kegiatan' => 'required|string',
            'uraian_kegiatan' => 'required|string',
            'saran_tindak_lanjut' => 'required|string',
            'penutup' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,jpg,png',
        ]);

        // Simpan data
        $atensi = new Atensi($validated);

        // Jika ada file, simpan
if ($request->hasFile('file')) {
    $file = $request->file('file');
    $filename = time() . '_' . $file->getClientOriginalName();
    $filePath = $file->storeAs('uploads', $filename, 'public');
    $atensi->file = '/storage/' . $filePath;
}


        $atensi->save();

        return redirect()->route('atensi.index')->with('success', 'Atensi berhasil dibuat.');
    }

    // Menampilkan form edit atensi
    public function edit($id)
    {
        $atensi = Atensi::findOrFail($id);
        return view('atensi.edit', compact('atensi'));
    }

    // Mengupdate data atensi
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal_waktu' => 'required|date',
            'yth' => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'pelaksanaan_kegiatan' => 'required|string|max:255',
            'uraian_kegiatan' => 'required|string|max:255',
            'saran_tindak_lanjut' => 'required|string|max:255',
            'penutup' => 'nullable|string',
            'file' => 'nullable|file|max:2048',
        ]);

        try {
            $atensi = Atensi::findOrFail($id);

            if ($request->hasFile('file')) {
                if ($atensi->file) {
                    Storage::delete($atensi->file);
                }
                $filePath = $request->file('file')->store('atensi_files', 'public'); // Simpan di public
                $atensi->file = $filePath;
            }

            $atensi->update($validatedData);

            return redirect()->route('atensi.index')->with('success', 'Data atensi berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage()]);
        }
    }

    
    // Menghapus data atensi
    public function destroy($id)
    {
        try {
            $atensi = Atensi::findOrFail($id);

            // Hapus file jika ada
            if ($atensi->file) {
                Storage::delete($atensi->file);
            }

            $atensi->delete();

            return redirect()->route('atensi.index')->with('success', 'Data atensi berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }


    public function show($id)
{
    $atensi = Atensi::find($id);
    
    if (!$atensi) {
        return redirect()->route('atensi.index')->with('error', 'Data tidak ditemukan');
    }
    return view('atensi.show', compact('atensi')); // Mengarahkan ke view dengan data
}

private function removeOldAtensis()
{
    $count = Atensi::count();
    if ($count > 5) {
       atensi::orderBy('tanggal', 'asc')->take($count - 5)->delete();
    }
}
}
