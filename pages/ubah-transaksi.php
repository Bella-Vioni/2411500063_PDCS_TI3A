<?php
//proteksi agar file tidak dapat diakses langsung
if(!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_transaksi = $_GET['id'];
    $sql = "SELECT * FROM transaksi WHERE id_transaksi = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id_transaksi);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $transaksi = $result->fetch_assoc();
            } else {
                echo "Data transaksi tidak ditemukan."; 
                exit();
            }
            $stmt->close();
        }
    } else {
        header("Location: index.php?hal=daftar-transaksi");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_transaksi = $_POST['id_transaksi'];
    $kategori_id = $_POST['kategori'];
    $judul = $_POST['judul'];
    $jumlah = $_POST['jumlah'];
    $tipe = strtolower($_POST['tipe']);
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];

    $sql = "UPDATE transaksi SET kategori_id = ?, tanggal = ?, judul = ?, tipe = ?, jumlah = ?,keterangan = ? WHERE id_transaksi = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("isssisi", $kategori_id, $tanggal, $judul, $tipe, $jumlah, $keterangan, $id_transaksi );
        if ($stmt->execute()) {
            $pesan = "Data transaksi berhasil di ubah";
            $result_transaksi = $mysqli->query("SELECT * FROM transaksi WHERE id_transaksi = $id_transaksi");
            $transaksi = $result_transaksi->fetch_assoc();
        } else {
            $pesan_error = "Terjadi kesalahan saat menyimpan data" . $stmt->error;
        }
        $stmt->close();
    }
}

?>

<div class="card mb-4">
        <div class="card-body">
            <?php if(!empty($pesan)) : ?>
                <div class="alert alert-success">
                    <?= $pesan ?>
                </div>
                <?php endif; ?>

                <?php if(!empty($pesan_error)) : ?>
                <div class="alert alert-danger">
                    <?= $pesan_error ?>
                </div>
            <?php endif; ?>
           <form method="post">
            <input type="hidden" name="id_transaksi" value="<?=$id_transaksi ?>">
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <?php $kategori = $mysqli->query("SELECT * FROM kategori"); while($row = $kategori->fetch_assoc()): ?>
                        <option value="<?= $row['id_kategori'] ?>"<?=($row['id_kategori']==$transaksi['kategori_id'])?'selected':'' ?>>
                            <?= $row['nama_kategori'] ?>
                        </option>
                    <?php endwhile ?>
                </select>
            </div>
             <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?php echo $transaksi['tanggal'] ?>"required>
             </div>
             <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" id="judul" value="<?php echo $transaksi['judul'] ?>" required>
             </div>
             <div class="mb-3">
                <label for="tipe" class="form-label">Tipe</label>
                    <select class="form-control" name="tipe">
                        <option value="">-- Pilih --</option>
                        <option value="masuk" <?=($transaksi['tipe']=='masuk')?'selected':'' ?>>Masuk</option>
                        <option value="keluar" <?=($transaksi['tipe']=='keluar')?'selected':'' ?>>Keluar</option>
                    </select>
            </div>  
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" id="jumlah" value="<?php echo $transaksi['jumlah'] ?>" required>
             </div>
             <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" id="keterangan" value="<?php echo $transaksi['keterangan'] ?>" required>
             </div>

             <button type="submit" class="btn btn-primary">Simpan</button>
             <a href="index.php?hal=daftar-transaksi" class="btn btn-danger">Kembali</a>
        </form> 
        </div>