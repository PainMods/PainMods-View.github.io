<?php
session_start();

// File untuk menyimpan data pengunjung
$dataFile = 'counter.txt';

// Membaca data dari file
if (file_exists($dataFile)) {
    $data = json_decode(file_get_contents($dataFile), true);
} else {
    $data = [
        'today' => 0,
        'all_time' => 0,
        'last_visit' => ''
    ];
}

// Mendapatkan tanggal hari ini
$today = date('Y-m-d');

// Memeriksa apakah hari ini sudah pernah dikunjungi
if ($data['last_visit'] !== $today) {
    // Reset jumlah pengunjung hari ini
    $data['today'] = 0;
    $data['last_visit'] = $today;
}

// Menambah jumlah pengunjung hari ini dan total
$data['today']++;
$data['all_time']++;

// Menyimpan kembali ke file
file_put_contents($dataFile, json_encode($data));

// Mengembalikan data sebagai JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
