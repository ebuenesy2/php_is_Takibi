<?php
session_start();
require_once '../config/about.php';
require_once '../config/Database.php';

// Giriş kontrolü
if (!isset($_SESSION['user'])) {  header("Location: ../views/login.php"); exit; }

//! --- Status Durum
$status = isset($_SESSION['status']) ? $_SESSION['status']  : [];
//echo "<pre>"; print_r($status); die();

$status_type = isset($_SESSION['status']) ? $status['type'] : "type yok";
// echo "status_type: "; echo $status_type; die();

$status_msg = isset($_SESSION['status']) ? $status['msg'] : "msg yok";
//echo "status_msg: "; echo $status_msg; die();

unset($_SESSION['status']); //! Sesion Siliyor

//! echo "sayisi: "; echo count($status); echo "<br>";

//! --- Status Durum -- Son


// Url Veriden UserId
$user_id_get = $_GET['user_id'] ?? ''; 
//echo "user_id_get: "; echo $user_id_get; die();


$user = $_SESSION['user'];
//echo "<pre>"; print_r($user); die();

$userId = $user['id'];
$userRole = $user['role'];
//echo "role:"; echo $userRole; die();

// Url Veri Çekme
$status_where = $_GET['status'] ?? 'Devam Ediliyor'; 
//echo "status_where: "; echo $status_where; die();

// Kullanıcı Listesi
$users = DB::table('users')
        ->leftJoin('users as updated_User ', 'users.updated_byId', '=', 'updated_User.id')
        ->select('users.*',  'updated_User.name as updated_User_name')->get();


?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Kullanıcı Listesi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h2>Merhaba, <?= htmlspecialchars($user['name']) ?> 👋</h2>
    <p>Kullanıcı Listesi</p>

    <a href="<?=$base_url;?>/views/user_register.php" class="btn btn-success mb-3">Yeni Kişi Ekle</a>
    <a href="<?=$base_url;?>/views/logout.php" class="btn btn-danger mb-3">Çıkış Yap</a>


    <!-- Alert -->
    <?php if (count($status) > 0 &&  $status['type'] == 'error' ) { ?>
    <div class="alert alert-danger"><?= $status['msg']?></div>
    <?php } else if ( count($status) > 0 &&  $status['type'] == 'success' ) { ?>
    <div class="alert alert-success"><?= $status['msg'] ?></div>
    <?php } ?>
    <!-- Alert Son -->

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>id</th>
          <th>Adı</th>
          <th>Oluşturma Tarihi</th>
          <th>Güncelleme Durumu</th>
          <th>Güncelleme Tarihi</th>
          <th>Güncelleme Y.Kişi</th>
          <th>İşlem</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $userInfo): ?>
          <tr>
            <td><?= htmlspecialchars($userInfo['id']) ?></td>
            <td><?= htmlspecialchars($userInfo['name']) ?></td>
            <td><?= htmlspecialchars($userInfo['created_at']) ?></td>
            <td><?= htmlspecialchars($userInfo['updated_status']) ?></td>
            <td><?= htmlspecialchars($userInfo['updated_at']) ?></td>
             <td><?= htmlspecialchars($userInfo['updated_User_name']) ?></td> 
            
              <td>
                <a href="<?=$base_url;?>/views/task_edit.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-warning">Düzenle</a>
                 <a href="<?=$base_url;?>/views/task_delete.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinizden emin misiniz?');">Sil</a>
              </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
