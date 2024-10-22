<html>
<head>
    <title>My App | Halaman Utama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row mt-3">
        <div class="col-4">
            <h3>Edit Data Pasien</h3>
            <?php
            // Menyertakan file koneksi.php agar variabel $koneksi tersedia
            include 'koneksi.php';

            $link = koneksi();  // Mendapatkan objek koneksi dari fungsi koneksi()

            // Pastikan koneksi berhasil sebelum menjalankan query
            if ($link) {
                // Query untuk mengambil data pasien berdasarkan id
                $panggil = $link->query("SELECT * FROM pasien_db WHERE idPasien='{$_GET['edit']}'");

                if ($panggil && $panggil->num_rows > 0) {
                    $row = $panggil->fetch_assoc(); // Ambil data dari hasil query
            ?>
            <form action="updatepasien.php" method="POST">
                <div class="form-group">
                    <label for="idPasien">ID Pasien</label>
                    <input type="text" class="form-control mb-3" name="idPasien" placeholder="ID Pasien" value="<?= htmlspecialchars($row['idPasien']) ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nmPasien">Nama Pasien</label>
                    <input type="text" class="form-control mb-3" name="nmPasien" placeholder="Nama Pasien" value="<?= htmlspecialchars($row['nmPasien']) ?>">
                </div>
                <div class="form-group">
                    <label for="jk">Jenis Kelamin</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="jk" value="Perempuan" <?= ($row['jk'] == "Perempuan") ? "checked" : "" ?>> Perempuan
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="jk" value="Laki-laki" <?= ($row['jk'] == "Laki-laki") ? "checked" : "" ?>> Laki-laki
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" cols="5" rows="3" placeholder="Alamat"><?= htmlspecialchars($row['alamat']) ?></textarea>
                </div>
                <div class="form-group mt-3">
                    <input type="submit" name="simpan" value="Simpan" class="form-control btn btn-primary">
                </div>
            </form>
            <?php
                } else {
                    echo "Data pasien tidak ditemukan.";
                }
            } else {
                echo "Koneksi database gagal.";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
