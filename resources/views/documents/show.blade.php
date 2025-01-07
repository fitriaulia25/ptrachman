<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Dokumen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f8;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 25px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }

        h1 {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        ul li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding: 8px 12px;
            background-color: #f9f9f9;
            border-radius: 5px;
            border: 1px solid #e8e8e8;
        }

        ul li strong {
            font-weight: bold;
            color: #555;
            width: 180px;
            flex-shrink: 0;
        }

        ul li span {
            flex-grow: 1;
            color: #333;
            text-align: left;
        }

        ul li a {
            color: #007BFF;
            text-decoration: none;
        }

        ul li a:hover {
            text-decoration: underline;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        .back-link:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            ul li {
                flex-direction: column;
                align-items: flex-start;
            }

            ul li strong {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <h1>Detail Dokumen</h1>
        <ul>
            <li><strong>Indeks:</strong> <span>{{ $document->indeks }}</span></li>
            <li><strong>Kode:</strong> <span>{{ $document->kode }}</span></li>
            <li><strong>Tanggal:</strong> <span>{{ $document->tanggal }}</span></li>
            <li><strong>No. Urut:</strong> <span>{{ $document->no_urut }}</span></li>
            <li><strong>Isi Ringkas:</strong> <span>{{ $document->isi_ringkas }}</span></li>
            <li><strong>Lampiran:</strong> <span>{{ $document->lampiran }}</span></li>
            <li><strong>Dari:</strong> <span>{{ $document->dari }}</span></li>
            <li><strong>Kepada:</strong> <span>{{ $document->kepada }}</span></li>
            <li><strong>Tanggal Surat:</strong> <span>{{ $document->tanggal_surat }}</span></li>
            <li><strong>No. Surat:</strong> <span>{{ $document->no_surat }}</span></li>
            <li><strong>Pengolahan:</strong> <span>{{ $document->pengolahan }}</span></li>
            <li><strong>Catatan:</strong> <span>{{ $document->catatan }}</span></li>
            <li><strong>Link Surat:</strong> 
                <span><a href="{{ $document->link_surat }}" target="_blank">{{ $document->link_surat }}</a></span>
            </li>
        </ul>
        <a href="{{ route('documents.index') }}" class="back-link">Kembali ke Daftar Dokumen</a>
    </div>
</body>
</html>
