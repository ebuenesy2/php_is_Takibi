<?php
session_start();
require_once '../config/Database.php';

if (!isset($_SESSION['user'])) { header("Location: ../views/login.php"); exit; }

$user = $_SESSION['user'];
//echo "<pre>"; print_r($user); die();

$userId = $user['id'];
$userRole = $user['role'];
//echo "userRole: "; echo $userRole; die();

//! Gelen Veri
$user_Get_Id = $_GET['id'] ?? 0;
//echo "user_Get_Id:"; echo $user_Get_Id; die();

//! Kullanıcı Bilgileri
$userFind = DB::table('users')->where('id', '=', $user_Get_Id)->get();
//echo "<pre>"; print_r($userFind); die();

//! Departman
$departmans = DB::table('departman')->orderBy('name', 'ASC')->get();
//echo "<pre>"; print_r($departmans); die();

  if (count($userFind) == 0 ) {  
  
    $_SESSION['status'] = [
      'type'      => "error",
      'msg'      => "Kullanıcı Bulunamadı",
    ];

    if($user['role'] =='admin') { header("Location: ../views/userList.php"); exit;    }
    if($user['role'] =='user') { header("Location: ../index.php"); exit; }
  }

  $user = $userFind[0]; //! Kullanıcı Bilgileri
  //echo "user_id:"; echo $user['id']; die();


?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Kullanıcı Düzenle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">

    <div style="display: flex;gap: 5px; margin-bottom: 15px; " >
      
      <?php if($userRole == 'admin') {  ?> <a href="../index.php" class="btn btn-success">Tüm Kullanici Liste</a> <?php } ?>

      <?php if ( $user['deleted_status'] == 0 || $userRole == 'admin'  ) { ?>  
      <a href="../controllers/user_delete_contoller.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinizden emin misiniz?');">Hesabı Sil</a>
      <?php } ?>

      <?php if ($user['deleted_status'] == 1 && $userRole == 'admin'  ) { ?>  
        <a href="../controllers/user_back_controller.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-info" onclick="return confirm('Silmek istediğinizden emin misiniz?');">Geri Al</a>
      <?php } ?>

    </div>

    <h3>Kullanıcı Düzenle</h3>
    <form action="../controllers/user_edit_control.php" method="POST">
      <input type="hidden" name="id" value="<?= $user['id'] ?>">

      <div class="mb-3">
        <label for="name" class="form-label">Ad</label>
        <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="surname" class="form-label"> Soyad</label>
        <input type="text" name="surname" id="surname" class="form-control" value="<?= htmlspecialchars($user['surname']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">E-posta</label>
        <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" readonly required >
      </div>


      <?php if($userRole == 'admin') { ?>
      <div class="mb-3" style="cursor: pointer;">
        <label for="user_departmnan" class="form-label">Departman</label>
       <select name="user_departmnan" id="user_departmnan" class="form-control">
        <option value="0">Departman Seç</option>
        <?php foreach ($departmans as $departman) { ?>
          <option value="<?= $departman['id'] ?>" <?= $user['departman'] == $departman['id'] ? 'selected' : '' ?>>
            <?= $departman['name'] ?>
          </option>
        <?php } ?>
        </select>
      </div>
      <?php } ?>

      <?php if($userRole == 'admin') { ?>
      <div class="mb-3" style="cursor: pointer;">
        <label for="user_role" class="form-label">Role</label>
        <select name="user_role" id="user_role" class="form-control">
            <option value="user" <?= $user['role'] == 'user'  ? 'selected' : '' ?> >user</option>
            <option value="admin" <?= $user['role'] == 'admin'  ? 'selected' : '' ?> >admin</option>
        </select>
      </div>
      <?php } ?>


      <button type="submit" class="btn btn-primary">Kaydet</button>
    </form>

    <br>

    <h3>Sifre Değiştir </h3>
    <form action="../controllers/user_edit_password_control.php" method="POST">
      <input type="hidden" name="id" value="<?= $user['id'] ?>">

       <div class="mb-3">
        <label for="password" class="form-label">Şifre</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>
      
      <div class="mb-3">
        <label for="newpassword" class="form-label">Yeni Şifre   </label>
        <input type="password" name="newpassword" id="newpassword" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="renewpassword" class="form-label">Yeni Şifre Tekrarla</label>
        <input type="password" name="renewpassword" id="renewpassword" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary">Değiştir ve Kaydet</button>
    </form>

  </div>
</body>
</html>
