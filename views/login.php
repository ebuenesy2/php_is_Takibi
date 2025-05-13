<?php 

session_start();
require_once '../config/about.php'; 


//! --- Status Durum
$status = isset($_SESSION['status']) ? $_SESSION['status']  : [];
//echo "<pre>"; print_r($status); die();

$status_type = isset($_SESSION['status']) ? $status['type'] : "type yok";
// echo "status_type: "; echo $status_type; die();

$status_msg = isset($_SESSION['status']) ? $status['msg'] : "msg yok";
//echo "status_msg: "; echo $status_msg; die();

unset($_SESSION['status']); //! Sesion Siliyor

//echo "sayisi: "; echo count($status); echo "<br>";

//! --- Status Durum -- Son

?>

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
      <?php if (count($status) > 0 &&  $status['type'] == 'error' ) { ?>
      <div class="alert alert-danger"><?= $status['msg']?></div>
      <?php } else if ( count($status) > 0 &&  $status['type'] == 'success' ) { ?>
      <div class="alert alert-success"><?= $status['msg'] ?></div>
      <?php } ?>
      <!-- Alert Son -->

      <form action="<?=$base_url;?>/controllers/login_control.php" method="POST">
        
        <?php if (isset($_GET['role']) && !empty($_GET['role']) && $_GET['role'] == 'user') { ?>
          <div class="mb-3">
            <label for="email" class="form-label">E-posta</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>
        <?php } else { ?>
          <div class="mb-3 d-none">
            <label for="email" class="form-label">E-posta - Admin</label>
            <input type="email" name="email" id="email" value="<?=$base_admin_email;?>" class="form-control" required>
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
          <?php } ?>
        
      </form>
    </div>
  </div>
</body>
</html>
