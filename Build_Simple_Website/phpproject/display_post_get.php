<?php
// ===== Model (akses database) =====
$host = "localhost";
$user = "root";
$pass = "";
$db   = "akademis_db"; // pastikan nama DB sesuai

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// ===== Controller (cek apakah GET/POST) =====
$nama   = null;
$method = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nama'])) {
    $nama   = $conn->real_escape_string($_POST['nama']);
    $method = "POST";
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nama'])) {
    $nama   = $conn->real_escape_string($_GET['nama']);
    $method = "GET";
}

// ===== Ambil data mahasiswa dari DB (jika ada nama yang dikirim) =====
$mahasiswa = null;
if ($nama) {
    $sql    = "SELECT * FROM mahasiswa WHERE nama LIKE '%$nama%'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $mahasiswa = $result->fetch_all(MYSQLI_ASSOC);
    }
}

$conn->close();
?>

<!-- ===== View (tampilkan hasil) ===== -->
<!DOCTYPE html>
<html>
<head>
    <title>Hasil Pencarian Mahasiswa</title>
</head>
<body>
    <h2>Hasil Input</h2>

    <?php if ($nama): ?>
        <p>Halo, <b><?= htmlspecialchars($nama) ?></b>! (dikirim via <?= $method ?>)</p>

        <?php if ($mahasiswa): ?>
            <h3>Data Mahasiswa yang ditemukan:</h3>
            <table border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Umur</th>
                </tr>
                <?php foreach ($mahasiswa as $mhs): ?>
                <tr>
                    <td><?= $mhs['nim'] ?></td>
                    <td><?= $mhs['nama'] ?></td>
                    <td><?= $mhs['umur'] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p style="color:red;">Tidak ada mahasiswa dengan nama tersebut.</p>
        <?php endif; ?>

    <?php else: ?>
        <p>Tidak ada data yang dikirim.</p>
    <?php endif; ?>
</body>
</html>
