<?php require_once '../config/about.php'; ?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Kayıt Ol</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="min-width: 350px;">
      <h3 class="text-center mb-4">Kayıt Ol</h3>

      <!-- Alert -->
      <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
      <?php elseif (isset($_GET['success'])): ?>
      <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
      <?php endif; ?>
       <!-- Alert Son -->

      <form action="<?=$base_url;?>/controllers/register_control.php" method="POST">
        <div class="mb-3">
          <label for="name" class="form-label">Ad</label>
          <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="surname" class="form-label"> Soyad</label>
          <input type="text" name="surname" id="surname" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">E-posta</label>
          <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Şifre</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Kayıt Ol</button>
        <p class="text-center mt-3">Zaten hesabınız var mı? <a href="login.php">Giriş Yap</a></p>
      </form>
    </div>
  </div>
</body>
</html>
