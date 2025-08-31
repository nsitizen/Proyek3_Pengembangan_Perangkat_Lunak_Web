<?php
$koneksi = new mysqli("localhost", "root", "", "akademis_db");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$where = "";
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $where = "WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%'";
}

$result = $koneksi->query("SELECT * FROM mahasiswa $where ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display Mahasiswa</title>
</head>
<body>
    <h2>Daftar Mahasiswa</h2>
    <a href="CRUD_mahasiswa.php">Kembali ke Form CRUD</a><br><br>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Umur</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nim'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['umur'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
