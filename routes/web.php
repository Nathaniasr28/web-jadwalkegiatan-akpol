<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $orang = [
        'Farera',
        'Reza',
        'Junaidi',
        'Putri'
    ];
    return view('home', [
        'orang' => $orang
    ]);
});

Route::get('/orang/{nama}', function ($nama) {

    $tanggal = request('tanggal', date('Y-m-d'));

    return view('jadwal.orang', [
        'nama' => strtoupper($nama),
        'tanggal' => $tanggal
    ]);

});