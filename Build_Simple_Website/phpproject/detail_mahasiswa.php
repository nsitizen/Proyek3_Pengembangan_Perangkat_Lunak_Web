<?php
// Konfigurasi koneksi
$host = "localhost";
$user = "root";        
$pass = "";        
$db   = "akademis_db";

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil NIM dari parameter URL
if (isset($_GET['nim'])) {
    $nim = $conn->real_escape_string($_GET['nim']);

    // Query detail mahasiswa
    $sql = "SELECT nim, nama, umur 
            FROM mahasiswa 
            WHERE nim = '$nim' 
            LIMIT 1";

    $result = $conn->query($sql);
} else {
    die("NIM tidak ditemukan di URL.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Mahasiswa</title>
</head>
<body>
    <h2>Detail Mahasiswa</h2>

    <?php if (isset($result) && $result->num_rows > 0): ?>
        <?php $row = $result->fetch_assoc(); ?>
        <p><b>NIM:</b> <?= $row['nim']; ?></p>
        <p><b>Nama:</b> <?= $row['nama']; ?></p>
        <p><b>Umur:</b> <?= $row['umur']; ?></p>
    <?php else: ?>
        <p style="color:red;">Data mahasiswa tidak ditemukan.</p>
    <?php endif; ?>

    <br>
    <a href="display_view_detail.php">Kembali ke Daftar Mahasiswa</a>
</body>
</html>

<?php
$conn->close();
?>
