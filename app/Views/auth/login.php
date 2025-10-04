<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f0f2f5; }
        .login-container { padding: 30px; background-color: white; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center; }
        input { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; }
        button { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Silakan Login</h2>
        
        <?php if(session()->getFlashdata('msg')): ?>
            <div class="error"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>
        
        <form action="<?= site_url('/login/attempt'); ?>" method="post">
            <?= csrf_field(); ?>
            <input type="text" name="username" placeholder="Username" required autofocus>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>