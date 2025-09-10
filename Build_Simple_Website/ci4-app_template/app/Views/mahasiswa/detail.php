<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title); ?></title>
</head>
<body>
    <h2>Detail Mahasiswa</h2>

    <form>
        <label for="nim">NIM:</label><br>
        <input type="text" id="nim" name="nim" value="<?= esc($mahasiswa['nim']); ?>" readonly><br><br>

        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" value="<?= esc($mahasiswa['nama']); ?>" readonly><br><br>

        <label for="umur">Umur:</label><br>
        <input type="text" id="umur" name="umur" value="<?= esc($mahasiswa['umur']); ?>" readonly><br><br>

        <a href="<?= site_url('mahasiswa'); ?>">Kembali ke Daftar Mahasiswa</a>
    </form>
</body>
</html>