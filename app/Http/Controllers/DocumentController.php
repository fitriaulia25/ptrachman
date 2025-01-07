<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    // Menampilkan semua dokumen
    public function index()
    {
        $documents = Document::latest()->get(); // Ambil data terbaru
        return view('documents.index', compact('documents'));
    }

    // Form tambah dokumen baru
    public function create()
    {
        return view('documents.form'); // Arahkan ke form tambah
    }

    // Menyimpan dokumen baru
    public function store(Request $request)
    {
        // Validasi input tanpa 'no_urut' karena akan di-generate otomatis
        $validated = $request->validate([
            'indeks' => 'required|string',
            'kode' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'isi_ringkas' => 'required|string',
            'lampiran' => 'nullable|string',
            'dari' => 'required|string',
            'kepada' => 'required|string',
            'tanggal_surat' => 'nullable|date',
            'no_surat' => 'nullable|string',
            'pengolahan' => 'nullable|string',
            'catatan' => 'nullable|string',
            'link_surat' => 'nullable|url',
        ]);
    
        // Ambil nomor urut yang tersedia
        $validated['no_urut'] = Document::getAvailableNumber();
    
        // Simpan data ke database
        $document = Document::create($validated);
    
        // Redirect ke halaman detail dokumen
        return redirect()->route('documents.show', $document->id)
                         ->with('success', 'Dokumen berhasil disimpan dengan nomor urut ' . $validated['no_urut'] . '!');
    }
    
    // Menampilkan detail dokumen
public function show($id)
{
    $document = Document::findOrFail($id);

    return view('documents.show', compact('document'));
}

    // Form edit dokumen
    public function edit($id)
    {
        $document = Document::findOrFail($id); // Cari dokumen
        return view('documents.form', compact('document')); // Arahkan ke form edit
    }

    // Update dokumen
public function update(Request $request, $id)
{
    // Validasi input
    $validated = $request->validate([
        'indeks' => 'required|string',
        'kode' => 'nullable|string',
        'tanggal' => 'nullable|date',
        'no_urut' => 'required|integer|min:1',
        'isi_ringkas' => 'required|string',
        'lampiran' => 'nullable|string',
        'dari' => 'required|string',
        'kepada' => 'required|string',
        'tanggal_surat' => 'nullable|date',
        'no_surat' => 'nullable|string',
        'pengolahan' => 'nullable|string',
        'catatan' => 'nullable|string',
        'link_surat' => 'nullable|url',
    ]);

    // Cari dokumen lama
    $document = Document::findOrFail($id);

    // Cek apakah no_urut sudah digunakan oleh dokumen lain
    $isUsed = Document::where('no_urut', $validated['no_urut'])
                      ->where('id', '!=', $id)
                      ->exists();
    if ($isUsed) {
        return back()->withErrors(['no_urut' => 'Nomor urut ini sudah digunakan!']);
    }

    // Update dokumen
    $document->update($validated);

    // Redirect ke halaman hasil inputan dengan pesan sukses
    return redirect()->route('documents.show', $document->id)
                     ->with('success', 'Dokumen berhasil diperbarui!');
}

    // Hapus dokumen
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
