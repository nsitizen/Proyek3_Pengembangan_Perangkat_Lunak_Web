<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <h3>Detail Mahasiswa</h3>

    <div style="line-height: 1.8;">
        <strong>NIM:</strong><br>
        <p><?= esc($mahasiswa['nim']); ?></p>

        <strong>Nama Lengkap:</strong><br>
        <p><?= esc($mahasiswa['nama']); ?></p>

        <strong>Tahun Masuk:</strong><br>
        <p><?= esc($mahasiswa['entry_year']); ?></p>
    </div>
    
    <br>
    <a href="<?= site_url('mahasiswa'); ?>" style="text-decoration: none; padding: 8px 12px; background-color: #6c757d; color: white; border-radius: 3px;">Kembali ke Daftar</a>

<?= $this->endSection(); ?>