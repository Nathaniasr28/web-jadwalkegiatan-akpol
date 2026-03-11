<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

$orang = [
    'Farera',
    'Reza',
    'Junaidi',
    'Putri'
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


Route::post('/simpan-jadwal', function (Request $request) {

    $jam = $request->jam;
    $tugas = $request->tugas;
    $tempat = $request->tempat;

    if($jam){

        for ($i = 0; $i < count($jam); $i++) {

            DB::table('jadwal')->insert([
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
                'jam' => $jam[$i],
                'tugas' => $tugas[$i],
                'tempat' => $tempat[$i],
                'status' => 0
            ]);

        }

    }
Route::post('/hapus-jadwal/{id}', function ($id) {

    DB::table('jadwal')->where('id', $id)->delete();

    return back();

});

Route::post('/edit-jadwal/{id}', function (Request $request, $id) {

    DB::table('jadwal')
        ->where('id', $id)
        ->update([
            'jam' => $request->jam,
            'tugas' => $request->tugas,
            'tempat' => $request->tempat,
            'status' => $request->status ? 1 : 0
        ]);

    return back();

});

    return back();

});