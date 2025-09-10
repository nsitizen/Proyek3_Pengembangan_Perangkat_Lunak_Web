<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <h3>Data Mahasiswa</h3>

    <?php if (session()->getFlashdata('pesan')): ?>
        <div style="padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; margin-bottom: 15px; border-radius: 5px;">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <a href="<?= site_url('/mahasiswa/create'); ?>" style="text-decoration: none; padding: 8px 12px; background-color: #007bff; color: white; border-radius: 5px; margin-bottom: 15px; display: inline-block;">Tambah Data</a>
    <br><br>
    
    <table>
        <thead>
            <tr>
                <th>Nim</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($mahasiswa)): ?>
                <?php foreach($mahasiswa as $row): ?>
                    <tr>
                        <td><?= esc($row['nim']); ?></td>
                        <td><?= esc($row['nama']); ?></td>
                        <td><?= esc($row['umur']); ?></td>
                        <td>
                            <a href="<?= site_url('/mahasiswa/detail/' . $row['nim']); ?>" class="btn btn-info">Detail</a>
                            <a href="<?= site_url('/mahasiswa/edit/' . $row['nim']); ?>" class="btn btn-warning">Edit</a>
                            <form action="<?= site_url('/mahasiswa/delete/' . $row['nim']); ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <button type="submit" onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Data tidak ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?= $this->endSection(); ?>