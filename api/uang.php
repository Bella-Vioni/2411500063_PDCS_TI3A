<?php

require "../includes/config.php";

function response($status, $msg, $data=null) {
    echo json_encode([
        "status" => $status,
        "message" => $msg,
        "data" => $data
    ]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    response("error", "Gunakan metode GET.!!");
}

$result = $mysqli->query("SELECT id_buku, judul, penulis, cover_buku FROM buku ORDER BY id_buku DESC");

$daftar = [];
while ($row = $result->fetch_assoc()) {
    $daftar[] = [
        "id_buku" => $row['id_buku'],
        "judul" => $row['judul'],
        "penulis" => $row['penulis'],     
        "cover_buku" => "http://localhost/admin-perpustakaan/pages/uploads/buku/" . $row['cover_buku']
    ];
}

response("success", "Daftar buku diambil", $daftar);