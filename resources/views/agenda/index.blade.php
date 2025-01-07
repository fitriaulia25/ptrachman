@extends('layouts.app')

@section('content')
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<div class="container">
    <h1>Daftar Agenda</h1>
    <a href="{{ route('agenda.create') }}" class="btn btn-secondary mb-3">Buat Agenda</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <style>
        /* Custom CSS for this page */
        .table {
            margin-top: 20px;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .table th {
            background-color: #343a40;
            color: white;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table tr:hover {
            background-color: #d6d8db;
        }
        .alert-success {
            margin-top: 20px;
        }
        .back-button {
            margin-top: 20px; /* Memberi jarak dari tabel */
        }
        .fixed-back-button {
    position: fixed;
    bottom: 20px; /* Jarak dari bawah layar */
    right: 20px; /* Jarak dari kanan layar */
    z-index: 1000; /* Pastikan berada di atas elemen lain */
}

    </style>
<form method="GET" action="{{ route('agenda.index') }}" class="mb-3">
    <div class="form-group d-flex align-items-center">
        
        <input type="text" name="tanggal" id="filterTanggal" class="form-control mr-2" placeholder="Pilih tanggal" style="width: 200px;">
        <button type="submit" class="btn btn-primary">Cari</button>
    </div>
</form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Acara/Kegiatan</th>
                <th>Pakaian</th>
                <th>Tempat</th>
                <th>Diikuti Oleh</th>
                <th>Keterangan</th>
                <th>Link Surat</th>
                <th>Laporan Kegiatan</th>
                <th>Dokumen Pendukung</th>
                <th scope="col" style="width: 15%">Aksi</th> <!-- Menambahkan scope pada kolom Aksi -->
            </tr>
        </thead>
        <tbody>
            @forelse($agendas as $agenda)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $agenda->waktu }}</td>
                    <td>{{ $agenda->acara_kegiatan }}</td>
                    <td>{{ $agenda->pakaian }}</td>
                    <td>{{ $agenda->tempat }}</td>
                    <td>{{ $agenda->diikuti_oleh }}</td>
                    <td>{{ $agenda->keterangan }}</td>
                    <td> <a href="{{ $agenda->link_surat }}" target="_blank" class="btn btn-secondary btn-sm" style="width: 120px; white-space: nowrap;">Lihat Surat</a></td>
                    <td>{{ $agenda->laporan_kegiatan }}</td>
                    <td>
                        @if($agenda->dokumen_data_pendukung)
                        <a href="{{ Storage::url($agenda->dokumen_data_pendukung) }}" target="_blank" class="btn btn-secondary btn-sm">Download</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('agenda.edit', $agenda->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">Tidak ada data agenda.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-end mt-3">
    @if(Auth::user()->role == 'user')
    <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 back-button fixed-back-button">Back</a>
    @elseif(Auth::user()->role == 'super_admin')
    <a href="{{ route('super_admin.dashboard') }}" class="btn btn-primary px-4 back-button fixed-back-button">Back</a>
    @endif
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#filterTanggal", {
            dateFormat: "Y-m-d", // Format sesuai dengan yang digunakan di database
            locale: "id" // Untuk bahasa Indonesia (opsional)
        });
    });
</script>
@endsection
