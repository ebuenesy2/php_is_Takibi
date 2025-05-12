<?php

session_start();
require_once '../config/about.php';
require_once '../config/Database.php';



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


// Giriş kontrolü
if (!isset($_SESSION['user'])) { header("Location: ../views/login.php"); exit; }

$user = $_SESSION['user'];
//echo "<pre>"; print_r($user); die();

$userId = $user['id'];
$userRole = $user['role'];
//echo "role:"; echo $userRole; die();

// Kullanıcının bilgileri al
$users=[];
if($userRole == 'admin') {   $users = DB::table('users')->get(); }
//echo "<pre>"; print_r($users); die();


?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Yeni Kişi Ekle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h3>Yeni Kişi Ekle</h3>
    <a href="../views/userList.php" class="btn btn-info mb-3 mt-3">Tüm Kullanıcı Listesi</a>

    
    <!-- Alert -->
    <?php if (count($status) > 0 &&  $status['type'] == 'error' ) { ?>
    <div class="alert alert-danger"><?= $status['msg']?></div>
    <?php } else if ( count($status) > 0 &&  $status['type'] == 'success' ) { ?>
    <div class="alert alert-success"><?= $status['msg'] ?></div>
    <?php } ?>
    <!-- Alert Son -->

    <form action="../controllers/register_control.php" method="POST">

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
        
        <div class="mb-3">
          <label for="repassword" class="form-label">Şifre Tekrarla</label>
          <input type="password" name="repassword" id="repassword" class="form-control" required>
        </div>

      
      <div class="mb-3">
        <label for="user_role" class="form-label">Role</label>
        <select name="user_role" id="user_role" class="form-control">
            <option value="user" selected >user</option>
            <option value="admin">admin</option>
        </select>
      </div>
      <button type="submit" class="btn btn-success">Yeni Kişi Kaydet</button>
    </form>
  </div>
</body>
</html>
