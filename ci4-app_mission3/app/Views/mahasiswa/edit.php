<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <h3>Form Ubah Data Mahasiswa</h3>

    <form action="<?= site_url('mahasiswa/update/' . $mahasiswa['student_id']); ?>" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" name="_method" value="PUT">

        <input type="hidden" name="nim_lama" value="<?= esc($mahasiswa['nim']); ?>">

        <label for="nim">NIM:</label><br>
        <input type="text" id="nim" name="nim" value="<?= old('nim', $mahasiswa['nim']); ?>" style="width: 100%; padding: 5px; margin-bottom: 10px;">
        <?php if ($validation->hasError('nim')): ?>
            <small style="color: red;"><?= $validation->getError('nim'); ?></small><br><br>
        <?php endif; ?>

        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" value="<?= old('nama', $mahasiswa['nama']); ?>" required style="width: 100%; padding: 5px; margin-bottom: 10px;">
        <?php if ($validation->hasError('nama')): ?>
            <small style="color: red;"><?= $validation->getError('nama'); ?></small><br><br>
        <?php endif; ?>

        <label for="entry_year">Tahun Masuk:</label><br>
        <input type="number" id="entry_year" name="entry_year" value="<?= old('entry_year', $mahasiswa['entry_year']); ?>" required style="width: 100%; padding: 5px; margin-bottom: 10px;">
        <?php if ($validation->hasError('entry_year')): ?>
            <small style="color: red;"><?= $validation->getError('entry_year'); ?></small><br><br>
        <?php endif; ?>

        <button type="submit" style="padding: 8px 12px; cursor: pointer;">Ubah Data</button>
        <a href="<?= site_url('mahasiswa'); ?>" style="text-decoration: none; padding: 8px 12px; background-color: #6c757d; color: white; border-radius: 3px;">Batal</a>
    </form>
<?= $this->endSection(); ?>