<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <h3>Form Tambah Mata Kuliah</h3>

    <form action="<?= site_url('courses/create'); ?>" method="post">
        <?= csrf_field(); ?>
        
        <label for="course_name">Nama Mata Kuliah:</label><br>
        <input type="text" id="course_name" name="course_name" value="<?= old('course_name'); ?>" style="width: 100%; padding: 5px; margin-bottom: 10px;">
        <?php if ($validation->hasError('course_name')): ?>
            <small style="color: red;"><?= $validation->getError('course_name'); ?></small><br><br>
        <?php else: ?>
            <br>
        <?php endif; ?>

        <label for="credits">Jumlah SKS:</label><br>
        <input type="number" id="credits" name="credits" value="<?= old('credits'); ?>" style="width: 100%; padding: 5px; margin-bottom: 10px;">
        <?php if ($validation->hasError('credits')): ?>
            <small style="color: red;"><?= $validation->getError('credits'); ?></small><br><br>
        <?php else: ?>
            <br>
        <?php endif; ?>

        <button type="submit" style="padding: 8px 12px; cursor: pointer;">Simpan</button>
        <a href="<?= site_url('courses'); ?>" style="text-decoration: none; padding: 8px 12px; background-color: #6c757d; color: white; border-radius: 3px;">Batal</a>
    </form>
<?= $this->endSection(); ?>