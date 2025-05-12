<?php
session_start();
require_once 'Database.php';

// Giriş kontrolü
if (!isset($_SESSION['user'])) {  header("Location: login.php"); exit; }

//! Status Durum
$status = isset($_SESSION['status']) ? $_SESSION['status']  : [];
//echo "<pre>"; print_r($status); die();

$status_type = isset($_SESSION['status']) ? $status['type'] : "type yok";
// echo "status_type: "; echo $status_type; die();

$status_msg = isset($_SESSION['status']) ? $status['msg'] : "msg yok";
//echo "status_msg: "; echo $status_msg; die();

unset($_SESSION['status']); //! Sesion Siliyor

//! echo "sayisi: "; echo count($status); echo "<br>";

//! Status Durum  - Son


$user = $_SESSION['user'];
//echo "<pre>"; print_r($user); die();

$userId = $user['id'];
$userRole = $user['role'];
//echo "role:"; echo $userRole; die();

// Url Veri Çekme
$status_where = $_GET['status'] ?? 'Devam Ediliyor'; 
//echo "status_where: "; echo $status_where; die();

// Kullanıcının görevlerini al
if($userRole == 'admin') {    
 
 $tasks = DB::table('tasks')
  ->join('users as user_id_user', 'tasks.user_id', '=', 'user_id_user.id')
  ->leftJoin('users as updated_User ', 'tasks.updated_byId', '=', 'updated_User.id')
  ->select('tasks.*', 'user_id_user.name as user_name', 'updated_User.name as updated_User_name');

  if ($status_where != 'tüm' && $status_where != 'Arşivlenen' ) { $tasks = $tasks->where('tasks.status', '=', $status_where); }
  if ($status_where == 'Arşivlenen') { $tasks = $tasks->where('tasks.deleted_status', '=', 1); }
  else if ($status_where != 'Arşivlenen') { $tasks = $tasks->where('tasks.deleted_status', '=', 0); }

  $tasks = $tasks->get();
  //echo "<pre>"; print_r($tasks); die();

  
  // Kullanıcının bilgileri al
  $users=[];
  if($userRole == 'admin') {   $users = DB::table('users')->get(); }
  //echo "<pre>"; print_r($users); die();
  
}
else {  

  $tasks = DB::table('tasks')->where('user_id', '=', $userId);
  if ($status_where != 'tüm' && $status_where != 'Arşivlenen' ) { $tasks = $tasks->where('tasks.status', '=', $status_where); }
  if ($status_where == 'Arşivlenen') { $tasks = $tasks->where('tasks.deleted_status', '=', 1); }
  else if ($status_where != 'Arşivlenen') { $tasks = $tasks->where('tasks.deleted_status', '=', 0); }

  $tasks = $tasks->get(); 

  //echo "<pre>"; print_r($tasks); die();

}


?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>İş Takibi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h2>Merhaba, <?= htmlspecialchars($user['name']) ?> 👋</h2>
    <p>İşleriniz aşağıda listelenmiştir:</p>

    <a href="task_add.php" class="btn btn-success mb-3">Yeni İş Ekle</a>
    <a href="logout.php" class="btn btn-danger mb-3">Çıkış Yap</a>

    <br>

    <a href="index.php?status=tüm" class="btn btn-success mb-3">Tüm</a>
    <a href="index.php" class="btn btn-warning mb-3">Bekliyor</a>
    <a href="index.php?status=Planlandı" class="btn btn-danger mb-3">Planlandı</a>
    <a href="index.php?status=Tamamlandı" class="btn btn-info mb-3">Tamamlandı</a>
    <a href="index.php?status=Arşivlenen" class="btn btn-danger mb-3">Arşivlenen</a>

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
          <?php if($userRole == 'admin') {  ?>  <th>Kullanıcı</th> <?php } ?>
          <th>Başlık</th>
          <th>Açıklama</th>
          <th>Durum</th>
          <th>Oluşturma Tarihi</th>
          <th>Güncelleme Durumu</th>
          <th>Güncelleme Tarihi</th>
          <?php if($userRole == 'admin') {  ?>  <th>Güncelleme Y.Kişi</th> <?php } ?>
          <th>İşlem</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tasks as $task): ?>
          <tr>
            <?php if($userRole == 'admin') {  ?>  <td><?= htmlspecialchars($task['user_name']) ?></td> <?php } ?>
            <td><?= htmlspecialchars($task['title']) ?></td>
            <td><?= htmlspecialchars($task['description']) ?></td>
            <td><?= htmlspecialchars($task['status']) ?></td>
            <td><?= htmlspecialchars($task['created_at']) ?></td>
            <td><?= htmlspecialchars($task['updated_status']) ?></td>
            <td><?= htmlspecialchars($task['updated_at']) ?></td>
            <?php if($userRole == 'admin') {  ?> <td><?= htmlspecialchars($task['updated_User_name']) ?></td> <?php } ?>
            
              <td>
                <a href="task_edit.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-warning">Düzenle</a>
                
                <?php if ($status_where != 'Arşivlenen' || $userRole == 'admin' ) { ?> 
                <a href="task_delete.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinizden emin misiniz?');">Sil</a>
                <?php } ?>

                <?php if ($status_where == 'Arşivlenen') { ?> 
                <a href="task_back.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-info" onclick="return confirm('Geri istediğinizden emin misiniz?');">Geri Al</a>
                <?php } ?>

              </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
