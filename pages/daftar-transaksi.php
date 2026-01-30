<?php
// proteksi
if(!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}

require_once "includes/config.php";

$id_user = $_SESSION['id_user'];

// ======== FILTER =========
$filter = $_GET['tipe'] ?? 'semua'; $where = "WHERE transaksi.user_id='$id_user'";
if ($filter == 'masuk') {
    $where .= " AND transaksi.tipe='masuk'";
} elseif ($filter == 'keluar') {
    $where .= " AND transaksi.tipe='keluar'";
}

// ======= AMBIL DATA ========
$query = "SELECT transaksi.*, kategori.nama_kategori FROM transaksi LEFT JOIN kategori ON transaksi.kategori_id = kategori.id_kategori $where ORDER BY transaksi.tanggal DESC";

$result = $mysqli->query($query);
if(!$result){
    die("Query error: " . $mysqli->error);
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Transaksi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Data Transaksi</li>
    </ol>

    <!-- FILTER -->
    <div class="mb-3">
        <a href="?page=transaksi&tipe=semua" class="btn btn-secondary btn-sm">Semua</a>
        <a href="?page=transaksi&tipe=masuk" class="btn btn-success btn-sm">Pemasukan</a>
        <a href="?page=transaksi&tipe=keluar" class="btn btn-danger btn-sm">Pengeluaran</a>
    </div>

    <!-- TABEL -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> Data Transaksi
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($result->num_rows > 0): ?>
                        <?php $no=1; while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                                <td><?= $row['judul'] ?></td>
                                <td><?= $row['nama_kategori'] ?></td>
                                <td>
                                    <?php if($row['tipe']=='masuk'): ?>
                                        <span class="badge bg-success">Masuk</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Keluar</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    Rp <?= number_format($row['jumlah'],0,',','.') ?>
                                </td>
                                <td><?= $row['keterangan'] ?></td>
                                <td>
                                <a href="index.php?hal=ubah-transaksi&id=<?php echo $row['id_transaksi'] ?>" class="btn btn-warning btn-sm">Ubah</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Belum ada transaksi</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>