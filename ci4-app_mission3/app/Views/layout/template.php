<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title ?? 'Welcome to My Website'); ?></title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .container { width: 800px; margin: 0 auto; border: 1px solid #000; }
        .header, .footer { padding: 15px; border-bottom: 1px solid #000; background-color: #f2f2f2; }
        .footer { border-top: 1px solid #000; border-bottom: none; }
        .menu { border-bottom: 1px solid #000; padding: 10px; text-align: left; }
        .menu a { margin-right: 20px; text-decoration: none; color: blue; font-weight: bold; }
        .content { padding: 30px; min-height: 200px; text-align: left; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #e9e9e9; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 3px; }
        .btn-info { background-color: #17a2b8; }
        .btn-warning { background-color: #ffc107; }
        .btn-danger { background-color: #dc3545; }
        form.d-inline { display: inline; }
        form.d-inline button { padding: 5px 10px; color: white; border-radius: 3px; border: none; cursor: pointer; background-color: #dc3545; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>WEBSITE AKADEMIK POLBAN</h2>
    </div>

    <div class="menu" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <a href="<?= site_url('/'); ?>">Home</a>
        
            <?php if(session()->get('role') == 'admin'): ?>
                <a href="<?= site_url('/mahasiswa'); ?>">Kelola Mahasiswa</a>
                <a href="<?= site_url('/courses'); ?>">Kelola Mata Kuliah</a>
            <?php elseif(session()->get('role') == 'mahasiswa'): ?>
                <a href="<?= site_url('/my-courses'); ?>">Mata Kuliah Saya</a>
                <a href="<?= site_url('/take-courses'); ?>">Ambil Mata Kuliah</a>
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
        <b>Bandung - Jawa Barat</b>
    </div>
</div>
</body>
</html>