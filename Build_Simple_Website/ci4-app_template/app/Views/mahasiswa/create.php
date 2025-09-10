<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title); ?></title>
</head>
<body>
    <h2>Form Tambah Data Mahasiswa</h2>

    <form action="<?= site_url('mahasiswa/save'); ?>" method="post">
        <?= csrf_field(); ?>
        
        <label for="nim">NIM:</label><br>
        <input type="text" id="nim" name="nim" required autofocus><br><br>

        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="umur">Umur:</label><br>
        <input type="number" id="umur" name="umur" required><br><br>

        <button type="submit">Tambah Data</button>
        <a href="../mahasiswa">Batal</a>
    </form>
</body>
</html>