<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'Web Akademik'); ?></title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- CSRF -->
  <meta name="csrf-token-name" content="<?= csrf_token() ?>">
  <meta name="csrf-token-hash" content="<?= csrf_hash() ?>">
  
  <style>
    .nav-link.active {
      font-weight: bold;
      color: #ffc107 !important;
      text-decoration: underline;
    }
    .is-invalid {
      border-color: #dc3545 !important;
    }
  </style>
</head>
<body>
<div class="container mt-4">
  <!-- HEADER -->
  <header class="mb-4">
    <h2 class="text-center">🌐 WEBSITE AKADEMIK POLBAN</h2>
  </header>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= site_url('/'); ?>">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <?php if(session()->get('role') == 'admin'): ?>
            <li class="nav-item"><a href="<?= site_url('/mahasiswa'); ?>" class="nav-link">Kelola Mahasiswa</a></li>
            <li class="nav-item"><a href="<?= site_url('/courses'); ?>" class="nav-link">Kelola Mata Kuliah</a></li>
          <?php elseif(session()->get('role') == 'mahasiswa'): ?>
            <li class="nav-item"><a href="<?= site_url('/my-courses'); ?>" class="nav-link">Mata Kuliah Saya</a></li>
            <li class="nav-item"><a href="<?= site_url('/take-courses'); ?>" class="nav-link">Ambil Mata Kuliah</a></li>
          <?php endif; ?>
        </ul>
        <span class="navbar-text">
          Halo, <b><?= esc(session()->get('username')); ?></b> (<?= esc(ucfirst(session()->get('role'))); ?>)!
          <a href="<?= site_url('/logout'); ?>" class="btn btn-sm btn-danger ms-2">Logout</a>
        </span>
      </div>
    </div>
  </nav>

  <!-- CONTENT START -->
  <main>
