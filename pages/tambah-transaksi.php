<?php
//proteksi agar file tidak dapat diakses langsung
if(!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}

require_once "includes/config.php";
$id_user = $_SESSION['id_user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori_id = $_POST['kategori'];
    $judul = $_POST['judul'];
    $jumlah = $_POST['jumlah'];
    $tipe = strtolower($_POST['tipe']);
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];

    $sql = "INSERT INTO transaksi (user_id,tanggal,judul,kategori_id,tipe,jumlah,keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("issisis", $id_user, $tanggal, $judul, $kategori_id, $tipe, $jumlah, $keterangan);
        if ($stmt->execute()) {
            $pesan = "Data transaksi berhasil di simpan";
            if ($tipe == 'masuk') {
                $mysqli->query("UPDATE saldo SET total_saldo = total_saldo + $jumlah WHERE user_id = $id_user");
            } else {
                $mysqli->query("UPDATE saldo SET total_saldo = total_saldo - $jumlah WHERE user_id = $id_user");
            }
        }
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Transaksi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tambah Transaksi</li>
    </ol>

    <?php if(!empty($pesan)) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $pesan; ?>
        </div>
    <?php endif ?>

    <?php if(!empty($pesan_error)) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $pesan_error; ?>
        </div>
    <?php endif ?>

    <div class="card mb-4">
        <div class="card-body">
           <form method="post">
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <?php $kategori = $mysqli->query("SELECT * FROM kategori"); while($row = $kategori->fetch_assoc()): ?>
                        <option value="<?= $row['id_kategori'] ?>">
                            <?= $row['nama_kategori'] ?>
                        </option>
                    <?php endwhile ?>
                </select>
            </div>
             <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="tanggal" required>
             </div>
             <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" id="judul" required>
             </div>
             <div class="mb-3">
                <label for="tipe" class="form-label">Tipe</label>
                    <select class="form-control" name="tipe" id="tipe">
                        <option value="">-- Pilih --</option>
                        <option value="masuk">Masuk</option>
                        <option value="keluar">Keluar</option>
                    </select>
            </div>  
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" id="jumlah" required>
             </div>
             <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" id="keterangan" required>
             </div>
             <button type="submit" class="btn btn-primary">Simpan</button>
             <a href="index.php?hal=daftar-transaksi" class="btn btn-danger">Kembali</a>
        </form> 
        </div>
    </div>