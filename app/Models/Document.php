<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
   protected $fillable = [
    'indeks', 'kode', 'tanggal', 'no_urut', 'isi_ringkas', 
    'lampiran', 'dari', 'kepada', 'tanggal_surat', 'no_surat', 
    'pengolahan', 'catatan', 'link_surat', // Menambahkan kolom link_surat
];

public static function getAvailableNumber()
{
    // Ambil semua nomor urut yang sudah terpakai
    $usedNumbers = self::pluck('no_urut')->toArray();

    // Cari nomor urut terkecil yang belum terpakai
    $availableNumber = 1;
    while (in_array($availableNumber, $usedNumbers)) {
        $availableNumber++;
    }

    return $availableNumber;
}


}
