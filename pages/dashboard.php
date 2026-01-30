<?php
//proteksi agar file tidak dapat diakses langsung
if(!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}

require_once "includes/config.php";
$id_user = $_SESSION['id_user'];

//========Total Pemasukan =========
$qMasuk = $mysqli->query("SELECT SUM(jumlah) AS total FROM transaksi WHERE user_id='$id_user' AND tipe='masuk'");
if(!$qMasuk) die($mysqli->error);
$totalMasuk = $qMasuk->fetch_assoc()['total'] ?? 0;

//========Total Pengeluaran =========
$qKeluar = $mysqli->query("SELECT SUM(jumlah) AS total FROM transaksi WHERE user_id='$id_user' AND tipe='keluar'");
if(!$qKeluar) die($mysqli->error);
$totalKeluar = $qKeluar->fetch_assoc()['total'] ?? 0;

//======== Saldo =========
$qJumlah = $mysqli->query("SELECT COUNT(*) AS total FROM transaksi WHERE user_id='$id_user'");
if(!$qJumlah) die($mysqli->error);
$jumlah = $qJumlah->fetch_assoc()['total'] ?? 0;

//======== Jumlah Transaksi =========
$total_saldo = $totalMasuk - $totalKeluar;
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4 ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h2 font-weight-bold">Rp <?= number_format($totalMasuk, 0, ',','.') ?></div>
                            <div class="text-uppercase font-weight-bold small">Total Pemasukan</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="index.php?hal=transaksi&tipe=masuk">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4 ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h2 font-weight-bold">Rp <?= number_format($totalKeluar, 0, ',','.') ?></div>
                            <div class="text-uppercase font-weight-bold small">Total Pengeluaran</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="index.php?hal=transaksi&tipe=keluar">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4 ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h2 font-weight-bold">Rp <?= number_format($total_saldo, 0, ',','.') ?></div>
                            <div class="text-uppercase font-weight-bold small">Saldo</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="index.php?hal=transaksi">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4 ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h2 font-weight-bold"><?= $jumlah ?></div>
                            <div class="text-uppercase font-weight-bold small">Jumlah Transaksi</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="index.php?hal=transaksi">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
