<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Surat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="date"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        button:hover {
            background-color: #0056b3;
        }

        .btn-cancel {
            background-color: #dc3545;
            text-decoration: none;
            padding: 10px 20px;
            color: #fff;
            border-radius: 4px;
            text-align: center;
            display: inline-block;
        }

        .btn-cancel:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Surat</h1>

        <!-- Form Edit Surat -->
        <form action="{{ route('documents.update', $document->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="indeks">Indeks:</label>
                <input type="text" id="indeks" name="indeks" value="{{ $document->indeks }}" required>
            </div>

            <div class="form-group">
                <label for="kode">Kode:</label>
                <input type="text" id="kode" name="kode" value="{{ $document->kode }}" required>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" value="{{ $document->tanggal }}" required>
            </div>

            <div class="form-group">
                <label for="no_urut">No. Urut:</label>
                <input type="number" id="no_urut" name="no_urut" value="{{ $document->no_urut }}" required>
            </div>

            <div class="form-group">
                <label for="isi_ringkas">Isi Ringkas:</label>
                <textarea id="isi_ringkas" name="isi_ringkas" rows="4" required>{{ $document->isi_ringkas }}</textarea>
            </div>

            <div class="form-group">
                <label for="dari">Dari:</label>
                <input type="text" id="dari" name="dari" value="{{ $document->dari }}" required>
            </div>

            <div class="form-group">
                <label for="kepada">Kepada:</label>
                <input type="text" id="kepada" name="kepada" value="{{ $document->kepada }}" required>
            </div>

            <div class="form-group">
                <label for="no_surat">No. Surat:</label>
                <input type="text" id="no_surat" name="no_surat" value="{{ $document->no_surat }}" required>
            </div>

            <div class="form-group">
                <label for="lampiran">Lampiran:</label>
                <input type="text" id="lampiran" name="lampiran" value="{{ $document->lampiran }}">
            </div>

            <div class="form-group">
                <label for="tanggal_surat">Tanggal Surat:</label>
                <input type="date" id="tanggal_surat" name="tanggal_surat" value="{{ $document->tanggal_surat }}">
            </div>

            <div class="form-group">
                <label for="pengolahan">Pengolahan:</label>
                <input type="text" id="pengolahan" name="pengolahan" value="{{ $document->pengolahan }}">
            </div>

            <div class="form-group">
                <label for="catatan">Catatan:</label>
                <textarea id="catatan" name="catatan" rows="4">{{ $document->catatan }}</textarea>
            </div>

            <div class="form-group">
                <label for="link_surat">Link Surat</label>
                <input type="text" id="link_surat" name="link_surat" value="{{ $document->link_surat }}" required>
            </div>

            <button type="submit">Simpan Perubahan</button>
            <a href="{{ route('documents.index') }}" class="btn-cancel">Batal</a>
        </form>
    </div>
    </body>
</html>
