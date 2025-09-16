<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <h3>Mata Kuliah yang Sudah Diambil</h3>

    <?php if (session()->getFlashdata('pesan')): ?>
        <div><?= session()->getFlashdata('pesan'); ?></div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($courses)): ?>
                <?php foreach($courses as $course): ?>
                    <tr>
                        <td><?= esc($course['course_name']); ?></td>
                        <td><?= esc($course['credits']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" style="text-align:center;">Anda belum mengambil mata kuliah apapun.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?= $this->endSection(); ?>