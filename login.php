<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Giriş Yap</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="min-width: 350px;">

      <?php if (isset($_GET['role']) && !empty($_GET['role']) && $_GET['role'] == 'user') { ?>
        <h3 class="text-center mb-4">Giriş Yap | Kullanıcı</h3>
      <?php } else { ?>
        <h3 class="text-center mb-4">Giriş Yap</h3>
      <?php } ?>

      <!-- Alert -->
      <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
      <?php elseif (isset($_GET['success'])): ?>
      <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
      <?php endif; ?>
      <!-- Alert Son -->

      <form action="login_control.php" method="POST">
        
        <?php if (isset($_GET['role']) && !empty($_GET['role']) && $_GET['role'] == 'user') { ?>
          <div class="mb-3">
            <label for="email" class="form-label">E-posta</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>
        <?php } else { ?>
          <div class="mb-3 d-none">
            <label for="email" class="form-label">E-posta - Admin</label>
            <input type="email" name="email" id="email" value="admin@tusdata.com" class="form-control" required>
          </div>
        <?php } ?>

        <div class="mb-3">
          <label for="password" class="form-label">Şifre</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
        
        
          <?php if (isset($_GET['role']) && !empty($_GET['role']) && $_GET['role'] == 'user') { ?>
            <p class="text-center mt-3">Admin için <a href="login.php">Admin Girişi</a></p>
          <?php } else { ?>
            <p class="text-center mt-3">Kullanıcı  için <a href="login.php?role=user">Kullanıcı Girişi</a></p>
            <p class="text-center mt-3">Yeni Hesap İçin <a href="register.php">Hesap Oluştur</a></p>
          <?php } ?>
        
      </form>
    </div>
  </div>
</body>
</html>
