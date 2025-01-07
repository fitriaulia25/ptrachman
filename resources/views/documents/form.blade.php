<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Dokumen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="date"],
        input[type="url"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group:last-child {
            margin-bottom: 0;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ isset($document) ? 'Edit Dokumen' : 'Tambah Dokumen' }}</h1>
        <form action="{{ isset($document) ? route('documents.update', $document->id) : route('documents.store') }}" method="POST">
            @csrf
            @if(isset($document))
                @method('PUT')
            @endif
            
            <div class="form-group">
                <label for="indeks">Indeks:</label>
                <input type="text" name="indeks" id="indeks" value="{{ old('indeks', $document->indeks ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="kode">Kode:</label>
                <input type="text" name="kode" id="kode" value="{{ old('kode', $document->kode ?? '') }}">
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $document->tanggal ?? '') }}">
            </div>
            <div class="form-group">
            <label for="no_urut">Nomor Urut</label>
            <input type="text" name="no_urut" id="no_urut" class="form-control" 
             value="{{ \App\Models\Document::getAvailableNumber() }}" 
             readonly>
          </div>
            <div class="form-group">
                <label for="isi_ringkas">Isi Ringkas:</label>
                <textarea name="isi_ringkas" id="isi_ringkas" required>{{ old('isi_ringkas', $document->isi_ringkas ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label for="lampiran">Lampiran:</label>
                <input type="text" name="lampiran" id="lampiran" value="{{ old('lampiran', $document->lampiran ?? '') }}">
            </div>
            <div class="form-group">
                <label for="dari">Dari:</label>
                <input type="text" name="dari" id="dari" value="{{ old('dari', $document->dari ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="kepada">Kepada:</label>
                <input type="text" name="kepada" id="kepada" value="{{ old('kepada', $document->kepada ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal_surat">Tanggal Surat:</label>
                <input type="date" name="tanggal_surat" id="tanggal_surat" value="{{ old('tanggal_surat', $document->tanggal_surat ?? '') }}">
            </div>
            <div class="form-group">
                <label for="no_surat">No. Surat:</label>
                <input type="text" name="no_surat" id="no_surat" value="{{ old('no_surat', $document->no_surat ?? '') }}">
            </div>
            <div class="form-group">
                <label for="pengolahan">Pengolahan:</label>
                <input type="text" name="pengolahan" id="pengolahan" value="{{ old('pengolahan', $document->pengolahan ?? '') }}">
            </div>
            <div class="form-group">
                <label for="catatan">Catatan:</label>
                <textarea name="catatan" id="catatan">{{ old('catatan', $document->catatan ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label for="link_surat">Link Surat:</label>
                <input type="url" name="link_surat" id="link_surat" value="{{ old('link_surat', $document->link_surat ?? '') }}">
            </div>
            <button type="submit">{{ isset($document) ? 'Update' : 'Simpan' }}</button>
        </form>
        <a href="{{ route('documents.index') }}">Kembali ke Daftar Dokumen</a>
    </div>
</body>
</html>
