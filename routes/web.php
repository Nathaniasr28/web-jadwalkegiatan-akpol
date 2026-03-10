<?php

use Illuminate\Support\Facades\Route;

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

    return view('jadwal.orang', [
        'nama' => strtoupper($nama),
        'tanggal' => $tanggal,
        'orang' => $orang
    ]);

});