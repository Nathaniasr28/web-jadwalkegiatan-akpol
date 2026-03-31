<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

$orang = [
    'Farera',
    'Reza',
    'Junaidi',
    'Putri',
    'Yudi',
    'Arul'
];

Route::get('/', function () use ($orang) {
    return view('home', [
        'orang' => $orang
    ]);
});

Route::get('/orang/{nama}', function ($nama) use ($orang) {

    $tanggal = request('tanggal', date('Y-m-d'));

    $jadwal = DB::table('jadwal')
        ->where('nama', strtolower($nama))
        ->where('tanggal', $tanggal)
        ->get();

    return view('jadwal.orang', [
        'nama' => strtoupper($nama),
        'tanggal' => $tanggal,
        'orang' => $orang,
        'jadwal' => $jadwal
    ]);
});

/* ===========================
   SIMPAN JADWAL (FIX)
=========================== */

Route::post('/simpan-jadwal', function (Request $request) {

    DB::table('jadwal')
        ->where('nama', $request->nama)
        ->where('tanggal', $request->tanggal)
        ->delete();

    if ($request->jam) {
        for ($i = 0; $i < count($request->jam); $i++) {

            $jam = $request->jam[$i] ?? null;
            $tugas = $request->tugas[$i] ?? null;
            $tempat = $request->tempat[$i] ?? null;

            // ⛔ SKIP kalau kosong / setengah kosong
            if (!$jam || !$tugas || !$tempat) {
                continue;
            }

            DB::table('jadwal')->insert([
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
                'jam' => $jam,
                'tugas' => $tugas,
                'tempat' => $tempat,
                'status' => isset($request->status[$i]) ? 1 : 0
            ]);
        }
    }

    return back();
});

/* ===========================
   HAPUS JADWAL
=========================== */

Route::post('/hapus-jadwal/{id}', function ($id) {

    DB::table('jadwal')
        ->where('id', $id)
        ->delete();

    return back();
});