<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <h3>Kelola Data Mahasiswa</h3>

    <?php if (session()->getFlashdata('pesan')): ?>
        <div style="padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; margin-bottom: 15px; border-radius: 5px;">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <a href="<?= site_url('/mahasiswa/new'); ?>" style="text-decoration: none; padding: 8px 12px; background-color: #007bff; color: white; border-radius: 5px; margin-bottom: 15px; display: inline-block;">Tambah Mahasiswa</a>
    <br><br>
    
    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Tahun Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($mahasiswa)): ?>
                <?php foreach($mahasiswa as $mhs): ?>
                    <tr>
                        <td><?= esc($mhs['nim']); ?></td>
                        <td><?= esc($mhs['nama']); ?></td>
                        <td><?= esc($mhs['entry_year']); ?></td>
                        <td>
                            <a href="<?= site_url('/mahasiswa/' . $mhs['student_id']); ?>" class="btn btn-info">Detail</a>
                            
                            <a href="<?= site_url('/mahasiswa/edit/' . $mhs['student_id']); ?>" class="btn btn-warning">Edit</a>
                            
                            <form action="<?= site_url('/mahasiswa/delete/' . $mhs['student_id']); ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Belum ada data mahasiswa.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?= $this->endSection(); ?>