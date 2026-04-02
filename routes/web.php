<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/* ===========================
   DATA ORANG
=========================== */

$orang = [
    'Farera',
    'Reza',
    'Junaidi',
    'Putri',
    'Yudi',
    'Arul',
    'Helga',
    'Dita'
];

/* ===========================
   HALAMAN HOME
=========================== */

Route::get('/', function () use ($orang) {
    return view('home', [
        'orang' => $orang
    ]);
});

/* ===========================
   HALAMAN JADWAL PER ORANG
=========================== */

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
   SIMPAN JADWAL
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

Route::get('/hapus-jadwal/{id}', function ($id) {

    DB::table('jadwal')
        ->where('id', $id)
        ->delete();

    return back();
});

/* ===========================
   UPLOAD FOTO PROFIL (FIX)
=========================== */

Route::post('/upload-foto', function (Request $request) {

    if ($request->hasFile('foto')) {

        $nama = strtolower($request->nama);

        // paksa jadi .jpg (biar konsisten)
        $filename = $nama . '.jpg';

        // simpan langsung
        $request->file('foto')->move(
            public_path('foto'),
            $filename
        );
    }

    return back();
});

/* ===========================
   HAPUS FOTO PROFIL (FIX)
=========================== */

Route::post('/hapus-foto', function (Request $request) {

    $nama = strtolower($request->nama);

    $pathJpg = public_path('foto/' . $nama . '.jpg');
    $pathPng = public_path('foto/' . $nama . '.png');

    if (file_exists($pathJpg)) unlink($pathJpg);
    if (file_exists($pathPng)) unlink($pathPng);

    return back();
});