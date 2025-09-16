<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <h3>Form Tambah Data Mahasiswa</h3>

    <form action="<?= site_url('mahasiswa/create'); ?>" method="post">
        <?= csrf_field(); ?>
        
        <label for="nim">NIM:</label><br>
        <input type="text" id="nim" name="nim" value="<?= old('nim'); ?>" style="width: 100%; padding: 5px; margin-bottom: 10px;">
        <?php if ($validation->hasError('nim')): ?>
            <small style="color: red;"><?= $validation->getError('nim'); ?></small><br><br>
        <?php endif; ?>

        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" value="<?= old('nama'); ?>" required style="width: 100%; padding: 5px; margin-bottom: 10px;">
        <?php if ($validation->hasError('nama')): ?>
            <small style="color: red;"><?= $validation->getError('nama'); ?></small><br><br>
        <?php endif; ?>

        <label for="entry_year">Tahun Masuk:</label><br>
        <input type="number" id="entry_year" name="entry_year" value="<?= old('entry_year'); ?>" required style="width: 100%; padding: 5px; margin-bottom: 10px;">
        <?php if ($validation->hasError('entry_year')): ?>
            <small style="color: red;"><?= $validation->getError('entry_year'); ?></small><br><br>
        <?php endif; ?>

        <button type="submit" style="padding: 8px 12px; cursor: pointer;">Simpan</button>
        <a href="<?= site_url('mahasiswa'); ?>" style="text-decoration: none; padding: 8px 12px; background-color: #6c757d; color: white; border-radius: 3px;">Batal</a>
    </form>
<?= $this->endSection(); ?>