<?php
namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Atensi;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Cari data di model Agenda
        $agenda = Agenda::where('acara_kegiatan', 'like', "%$query%")
            ->orWhere('tanggal', 'like', "%$query%")
            ->first();

        if ($agenda) {
            return redirect()->route('agenda.edit', $agenda->id);
        }

        // Cari data di model Atensi
        $atensi = Atensi::where('kegiatan', 'like', "%$query%")
            ->orWhere('yth', 'like', "%$query%")
            ->first();

        if ($atensi) {
            return redirect()->route('atensi.edit', $atensi->id);
        }

        // Jika tidak ditemukan
        return back()->with('error', 'Data tidak ditemukan!');
    }
}
