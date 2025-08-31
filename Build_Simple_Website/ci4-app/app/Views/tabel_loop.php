<table border="1">
    <tr><th>NIM</th><th>Nama</th></tr>
    <?php foreach ($mahasiswa as $m): ?>
        <tr>
            <td><?= $m['nim']; ?></td>
            <td><?= $m['nama']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
