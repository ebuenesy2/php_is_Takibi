<?php

session_start();
require_once '../config/about.php';
require_once '../config/Database.php';

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
  <title>Yeni İş Ekle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h3>Yeni İş Ekle</h3>
    <form action="../controllers/task_add_control.php" method="POST">

     <?php if($userRole == 'admin') {  ?>
      <div class="mb-3">
        <label for="user_id" class="form-label">Kullanıcı</label>
        <select name="user_id" id="user_id" class="form-control"  style=" cursor: pointer; " >
          <?php foreach ($users as $user ) { ?>
            <option value="<?=$user['id'] ?>" style=" cursor: pointer; " ><?=$user['name'] ?></option>
         <?php }  ?>
        </select>
      </div>
      <?php }  ?>
      <div class="mb-3">
        <label for="title" class="form-label">Başlık</label>
        <input type="text" name="title" id="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Açıklama</label>
        <textarea name="description" id="description" class="form-control" required></textarea>
      </div>
      <div class="mb-3">
        <label for="status" class="form-label">Durum</label>
        <select name="status" id="status" class="form-control">
          <option value="Planlandı">Planlandı</option>
          <option value="Devam Ediliyor" selected >Devam Ediliyor</option>
          <option value="Tamamlandı">Tamamlandı</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">İşi Kaydet</button>
    </form>
  </div>
</body>
</html>
