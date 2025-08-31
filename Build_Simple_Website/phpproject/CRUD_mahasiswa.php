<?php
// Koneksi database
$koneksi = new mysqli("localhost", "root", "", "akademis_db");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// CREATE - Tambah data
if (isset($_POST['tambah'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];

    $koneksi->query("INSERT INTO mahasiswa (nim, nama, umur) VALUES ('$nim', '$nama', '$umur')");
    echo "<p style='color:green;'>Data berhasil ditambahkan!</p>";
}

// UPDATE - Ubah data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];

    $koneksi->query("UPDATE mahasiswa SET nim='$nim', nama='$nama', umur='$umur' WHERE id=$id");
    echo "<p style='color:blue;'>Data berhasil diupdate!</p>";
}

// DELETE - Hapus data
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $koneksi->query("DELETE FROM mahasiswa WHERE id=$id");
    echo "<p style='color:red;'>Data berhasil dihapus!</p>";
}

// SEARCH - Cari data (hanya redirect ke display_mahasiswa.php dengan keyword)
if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    header("Location: display_mahasiswa.php?keyword=" . urlencode($keyword));
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa</title>
</head>
<body>
    <h2>Form Tambah Mahasiswa</h2>
    <form method="post" action="">
        <label>NIM:</label><br>
        <input type="text" name="nim" required><br>
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br>
        <label>Umur:</label><br>
        <input type="number" name="umur" required><br><br>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <h2>Form Update Mahasiswa</h2>
    <form method="post" action="">
        <label>ID Mahasiswa (yang mau diupdate):</label><br>
        <input type="number" name="id" required><br>
        <label>NIM Baru:</label><br>
        <input type="text" name="nim" required><br>
        <label>Nama Baru:</label><br>
        <input type="text" name="nama" required><br>
        <label>Umur Baru:</label><br>
        <input type="number" name="umur" required><br><br>
        <button type="submit" name="update">Update</button>
    </form>

    <h2>Form Hapus Mahasiswa</h2>
    <form method="post" action="">
        <label>ID Mahasiswa yang mau dihapus:</label><br>
        <input type="number" name="id" required><br><br>
        <button type="submit" name="hapus" onclick="return confirm('Yakin hapus data?')">Hapus</button>
    </form>

    <h2>Cari Mahasiswa</h2>
    <form method="post" action="">
        <input type="text" name="keyword" placeholder="Cari NIM/Nama">
        <button type="submit" name="cari">Cari</button>
    </form>

    <br><br>
    <a href="display_mahasiswa.php">Lihat Daftar Mahasiswa</a>
</body>
</html>
