<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <h3>Detail Mata Kuliah</h3>

    <div style="line-height: 1.8;">
        <strong>Nama Mata Kuliah:</strong><br>
        <p><?= esc($course['course_name']); ?></p>

        <strong>Jumlah SKS:</strong><br>
        <p><?= esc($course['credits']); ?></p>
    </div>
    
    <br>
    <a href="<?= site_url('courses'); ?>" style="text-decoration: none; padding: 8px 12px; background-color: #6c757d; color: white; border-radius: 3px;">Kembali ke Daftar</a>

<?= $this->endSection(); ?>