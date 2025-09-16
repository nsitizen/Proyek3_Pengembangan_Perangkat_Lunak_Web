<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <h3>Kelola Data Mata Kuliah</h3>

    <?php if (session()->getFlashdata('pesan')): ?>
        <div style="padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; margin-bottom: 15px; border-radius: 5px;">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <a href="<?= site_url('/courses/new'); ?>" style="text-decoration: none; padding: 8px 12px; background-color: #007bff; color: white; border-radius: 5px; margin-bottom: 15px; display: inline-block;">Tambah Mata Kuliah</a>
    <br><br>
    
    <table>
        <thead>
            <tr>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($courses)): ?>
                <?php foreach($courses as $course): ?>
                    <tr>
                        <td><?= esc($course['course_name']); ?></td>
                        <td><?= esc($course['credits']); ?></td>
                        <td>
                            <a href="<?= site_url('/courses/edit/' . $course['course_id']); ?>" class="btn btn-warning">Edit</a>
                            <form action="<?= site_url('/courses/delete/' . $course['course_id']); ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align:center;">Belum ada data mata kuliah.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?= $this->endSection(); ?>