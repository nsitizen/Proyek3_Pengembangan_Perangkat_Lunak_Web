<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title ?? 'Website Penghitung Gaji DPR'); ?></title>

    <meta name="csrf-token-name" content="<?= csrf_token() ?>">
    <meta name="csrf-token-hash" content="<?= csrf_hash() ?>">

    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .container { width: 800px; margin: 0 auto; border: 1px solid #000; }
        .header, .footer { padding: 15px; border-bottom: 1px solid #000; background-color: #f2f2f2; }
        .footer { border-top: 1px solid #000; border-bottom: none; }
        .menu { border-bottom: 1px solid #000; padding: 10px; text-align: left; }
        .menu a { margin-right: 20px; text-decoration: none; color: blue; font-weight: bold; }
        .menu a.active { color: #ffc107; text-decoration: underline; }
        .content { padding: 30px; min-height: 200px; text-align: left; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #e9e9e9; }
        .btn:hover { padding: 5px 10px; text-decoration: none; color: white; border-radius: 3px; }
        .btn-info:hover { background-color: #17a2b8; }
        .btn-warning:hover { background-color: #ffc107; }
        .btn-danger:hover { background-color: #dc3545; }
        .is-invalid { border-color: #dc3545 !important; border-width: 2px; }
        form.d-inline { display: inline; }
        form.d-inline button { padding: 5px 10px; color: white; border-radius: 3px; border: none; cursor: pointer; background-color: #dc3545; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>APLIKASI PENGHITUNGAN & TRANSPARANSI GAJI DPR BERBASIS WEB</h2>
    </div>

    <div class="menu" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <a href="<?= site_url('/'); ?>" class="nav-link">Home</a>
            <?php if(session()->get('role') == 'admin'): ?>
                <a href="<?= site_url('/mahasiswa'); ?>" class="nav-link">Kelola Mahasiswa</a>
                <a href="<?= site_url('/courses'); ?>" class="nav-link">Kelola Mata Kuliah</a>
            <?php elseif(session()->get('role') == 'mahasiswa'): ?>
                <a href="<?= site_url('/my-courses'); ?>" class="nav-link">Mata Kuliah Saya</a>
                <a href="<?= site_url('/take-courses'); ?>" class="nav-link">Ambil Mata Kuliah</a>
            <?php endif; ?>
        </div>
        <div>
            <span>Halo, <b><?= esc(session()->get('username')); ?></b> (<?= esc(ucfirst(session()->get('role'))); ?>)!</span>
            <a href="<?= site_url('/logout'); ?>" style="color: red; margin-left: 15px;">Logout</a>
        </div>
    </div>

    <div class="content">
        <?= $this->renderSection('content'); ?>
    </div>

    <div class="footer">
        <b>Indonesia</b>
    </div>
</div>
<div id="delete-confirmation-modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:1000;">
    <div style="background-color:white; width:400px; margin: 15% auto; padding: 20px; border-radius: 5px; text-align:center;">
        <h4>Konfirmasi Penghapusan</h4>
        <p id="delete-modal-message">Apakah Anda yakin?</p>
        <hr>
        <button id="confirm-delete-btn" style="background-color: #dc3545; color: white; padding: 8px 12px; border: none; cursor:pointer;">Ya, Hapus</button>
        <button id="cancel-delete-btn" style="background-color: #6c757d; color: white; padding: 8px 12px; border: none; cursor:pointer;">Batal</button>
    </div>
</div>
<script src="<?= base_url('js/app.js') ?>"></script>
</body>
</html>