<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Surat</title>
    <!-- Link Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 5px;
            font-size: 14px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn i {
            margin-right: 5px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #a71d2a;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .action-btns {
            display: flex;
            gap: 10px;
        }

        .action-btns form {
            margin: 0;
        }

        .link-surat a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .link-surat a:hover {
            text-decoration: underline;
        }

        .link-surat i {
            margin-right: 5px;
            color: #007bff;

            
        }
        .back-button, .export-button {
            position: fixed;
            bottom: 20px;
        }
        .back-button {
            right: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Surat</h1>

        @if(session('success'))
            <div style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background-color: #28a745; color: white; padding: 15px 30px; border-radius: 5px; font-size: 16px; z-index: 1000; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Tombol Create -->
        <a href="{{ route('documents.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Tambah Surat
        </a>

        <!-- Tabel Data -->
        <table>
            <thead>
                <tr>
                    <th>Indeks</th>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>No. Urut</th>
                    <th>Isi Ringkas</th>
                    <th>Lampiran</th>
                    <th>Dari</th>
                    <th>Kepada</th>
                    <th>Tanggal Surat</th>
                    <th>No. Surat</th>
                    <th>Pengolahan</th>
                    <th>Catatan</th>
                    <th>Link Surat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                    <tr>
                        <td>{{ $document->indeks }}</td>
                        <td>{{ $document->kode }}</td>
                        <td>{{ $document->tanggal }}</td>
                        <td>{{ $document->no_urut }}</td>
                        <td>{{ $document->isi_ringkas }}</td>
                        <td>{{ $document->lampiran }}</td>
                        <td>{{ $document->dari }}</td>
                        <td>{{ $document->kepada }}</td>
                        <td>{{ $document->tanggal_surat }}</td>
                        <td>{{ $document->no_surat }}</td>
                        <td>{{ $document->pengolahan }}</td>
                        <td>{{ $document->catatan }}</td>
                        <td class="link-surat">
                            <a href="{{ $document->link_surat }}" target="_blank">
                                <i class="fas fa-link"></i> Lihat Surat
                            </a>
                        </td>
                        <td class="action-btns">
                            <!-- Tombol Edit -->
                            <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <!-- Tombol Delete -->
                            <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</body>
<div class="d-flex justify-content-end mt-3">
    @if(Auth::user()->role == 'user')
        <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 back-button fixed-back-button">Back</a>
    @elseif(Auth::user()->role == 'super_admin')
        <a href="{{ route('super_admin.dashboard') }}" class="btn btn-primary px-4 back-button fixed-back-button">Back</a>
    @endif
</div>
</html>
