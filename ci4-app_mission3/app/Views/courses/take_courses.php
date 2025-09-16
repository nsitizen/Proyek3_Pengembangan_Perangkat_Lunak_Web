<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <h3>Ambil Mata Kuliah</h3>

    <?php if (session()->getFlashdata('pesan')): ?>
        <div><?= session()->getFlashdata('pesan'); ?></div>
    <?php endif; ?>

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
                            <a href="<?= site_url('/courses/enroll/' . $course['course_id']); ?>">Ambil</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align:center;">Tidak ada mata kuliah baru yang tersedia.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?= $this->endSection(); ?>