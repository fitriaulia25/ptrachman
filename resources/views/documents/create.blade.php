<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Surat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f9f9f9;
        }

        .form-container {
            width: 700px;
            padding: 20px;
            border: 1px solid #000;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 10px;
        }

        .form-header h1 {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }

        .form-header p {
            font-size: 14px;
            margin: 5px 0 15px;
            line-height: 1.4;
        }

        hr {
            border: 1px solid #000;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            margin-bottom: 10px;
            align-items: center;
        }

        .form-group label {
            width: 180px;
            font-size: 14px;
            margin-right: 10px;
        }

        .form-group input,
        .form-group textarea {
            flex: 1;
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-group textarea {
            height: 50px;
        }

        .form-group:last-child {
            justify-content: flex-end;
        }

        .form-group button {
            padding: 8px 16px;
            font-size: 14px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .form-footer {
            margin-top: 20px;
            text-align: right;
        }

        .form-footer a {
            font-size: 14px;
            color: #007BFF;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1>Kementerian Hukum dan HAM RI</h1>
            <p>Kantor Wilayah Jawa Barat<br>Lembaga Pemasyarakatan Kelas II B Garut</p>
        </div>
        <hr>
        <form action="{{ route('documents.store') }}" method="POST">
            @csrf
           <div class="form-group">
                <label>Indeks:</label>
                <input type="text" name="indeks" required>
            </div>
            <div class="form-group">
                <label>Kode:</label>
                <input type="text" name="kode">
            </div>
            <div class="form-group">
                <label>Tanggal:</label>
                <input type="date" name="tanggal">
            </div>
            <div class="form-group">
                <label>No. Urut :</label>
                <input type="text" name="no_urut">
            </div>
            <div class="form-group">
                <label>Isi Ringkas:</label>
                <textarea name="isi_ringkas" required></textarea>
            </div>
            <div class="form-group">
                <label>Lampiran:</label>
                <input type="text" name="lampiran">
            </div>
            <div class="form-group">
                <label>Dari:</label>
                <input type="text" name="dari" required>
            </div>
            <div class="form-group">
                <label>Kepada:</label>
                <input type="text" name="kepada" required>
            </div>
            <div class="form-group">
                <label>Tanggal Surat:</label>
                <input type="date" name="tanggal_surat">
            </div>
            <div class="form-group">
                <label>No. Surat:</label>
                <input type="text" name="no_surat">
            </div>
            <div class="form-group">
                <label>Pengolahan:</label>
                <input type="text" name="pengolahan">
            </div>
            <div class="form-group">
                <label>Catatan:</label>
                <textarea name="catatan"></textarea>
            </div>
            
            <div class="form-group">
    <label>Link Surat:</label>
    <input type="url" name="link_surat" placeholder="Masukkan URL surat">
</div>
            <div class="form-group">
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
