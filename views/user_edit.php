<?php
session_start();
require_once '../config/Database.php';

echo "deneme"; die();

if (!isset($_SESSION['user'])) { header("Location: ../views/login.php"); exit; }

$user = $_SESSION['user'];
//echo "<pre>"; print_r($user); die();

$userId = $user['id'];
$userRole = $user['role'];
$taskId = $_GET['id'] ?? 0;
//echo "userRole: "; echo $userRole; die();

// Görev çek
$task = DB::table('tasks')->where('id', '=', $taskId)->get();

if (!$task ) { die("Bu görev bulunamadı."); }
else if (!$task || $task[0]['user_id'] != $userId && $user['role'] =='user' ) { die("Bu görevi düzenlemeye yetkiniz yok."); }

$task = $task[0];

//echo "user_id:"; echo $task['user_id']; die();


// Kullanıcının bilgileri al
$users=[];
if($userRole == 'admin') {   $users = DB::table('users')->get(); }
//echo "<pre>"; print_r($users); die();

?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>İşi Düzenle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">

    <div style="display: flex;gap: 5px; margin-bottom: 15px; " >
      <a href="../index.php" class="btn btn-success">Tüm Liste</a>

      <?php if ( $task['deleted_status'] == 0 || $userRole == 'admin'  ) { ?>  
      <a href="../views/task_delete.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinizden emin misiniz?');">Sil</a>
      <?php } ?>

      <?php if ($task['deleted_status'] == 1 ) { ?>  
        <a href="../views/task_back.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-info" onclick="return confirm('Silmek istediğinizden emin misiniz?');">Geri Al</a>
      <?php } ?>

    </div>

    <h3>İşi Düzenle</h3>
    <form action="../controllers/task_edit_control.php" method="POST">
      <input type="hidden" name="id" value="<?= $task['id'] ?>">

      <?php if($userRole == 'admin') {  ?>
      <div class="mb-3">
        <label for="user_id" class="form-label">Kullanıcı</label>
        <select name="user_id" id="user_id" class="form-control"  style=" cursor: pointer; " >
          <?php foreach ($users as $user ) { ?>
            <option value="<?=$user['id'] ?>" style=" cursor: pointer; "  
              <?= ($user['id'] == $task['user_id']) ? 'selected' : '' ?>
            ><?=$user['name'] ?></option>
         <?php }  ?>
        </select>
      </div>
      <?php }  ?>

      <div class="mb-3">
        <label class="form-label">Başlık</label>
        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($task['title']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Açıklama</label>
        <textarea name="description" class="form-control" required><?= htmlspecialchars($task['description']) ?></textarea>
      </div>
      <div class="mb-3">
        <label for="status" class="form-label">Durum</label>
        <select name="status" id="status" class="form-control">
          <option value="Planlandı"  <?= $task['status'] == 'Planlandı'  ? 'selected' : '' ?> >Planlandı</option>
          <option value="Devam Ediliyor" <?= $task['status'] == 'Devam Ediliyor'  ? 'selected' : '' ?> >Devam Ediliyor</option>
          <option value="Tamamlandı" <?= $task['status'] == 'Tamamlandı'  ? 'selected' : '' ?> >Tamamlandı</option>
        </select>
      </div>



      <button type="submit" class="btn btn-primary">Kaydet</button>
    </form>
  </div>
</body>
</html>
