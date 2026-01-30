<?php

require "../includes/config.php";

function response($status, $message, $data=null) {
    echo json_encode([
        "status" => $status,
        "message" => $message,
        "data" => $data
    ]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    response("false", "Gunakan metode GET.!!");
}

$result = $mysqli->query("SELECT id_transaksi, kategori_id, judul, jumlah, tipe, tanggal, keterangan FROM transaksi ORDER BY id_transaksi DESC");

$daftar = [];
while ($row = $result->fetch_assoc()) {
    $daftar[] = [
        "id_transaksi" => $row['id_transaksi'],
        "kategori_id" => $row['kategori_id'],
        "judul" => $row['judul'],
        "jumlah" => $row['jumlah'], 
        "tipe" => $row['tipe'], 
        "tanggal" => $row['tanggal'],
        "keterangan" => $row['keterangan'],      
        "detail_url" => "http://localhost/keuangan/index.php?hal=daftar-transaksi&id=" . $row['id_transaksi']
    ];
}

response("true", "Daftar transaksi diambil", $daftar);