<?php
session_start();
require_once 'config/about.php';
require_once 'config/Database.php';

// Giriş kontrolü
if (!isset($_SESSION['user'])) {  header("Location: views/login.php"); exit; }

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
$departman_id_get = $_GET['departman_id'] ?? ''; 
//echo "user_id_get: "; echo $user_id_get; die();


$user = $_SESSION['user'];
//echo "<pre>"; print_r($user); die();

$userId = $user['id'];
$userRole = $user['role'];
//echo "role:"; echo $userRole; die();

// Url Veri Çekme
$status_where = $_GET['status'] ?? 'Devam Ediliyor'; 
//echo "status_where: "; echo $status_where; die();

//! Zaman
$start_date = $_GET['start_date'] ?? null;
$end_date = $_GET['end_date'] ?? null;
//echo "zaman:"; echo $end_date; die();

// Kullanıcının görevlerini al
if($userRole == 'admin') {    
 
 $tasks = DB::table('tasks')
  ->join('users as user_id_user', 'tasks.user_id', '=', 'user_id_user.id')
  ->leftJoin('departman', 'departman.id', '=', 'user_id_user.departman')
  ->leftJoin('users as updated_User ', 'tasks.updated_byId', '=', 'updated_User.id')
  ->select('tasks.*', 'user_id_user.name as user_name', 'user_id_user.surname as user_surname', 
           'updated_User.name as updated_User_name',
           'departman.id as departmanId','departman.name as departmanTitle');

  if ($status_where != 'tüm' && $status_where != 'Arşivlenen' ) { $tasks = $tasks->where('tasks.status', '=', $status_where); }
  if ($status_where == 'Arşivlenen') { $tasks = $tasks->where('tasks.deleted_status', '=', 1); }
  else if ($status_where != 'Arşivlenen') { $tasks = $tasks->where('tasks.deleted_status', '=', 0); }
  if ($user_id_get ) { $tasks = $tasks->where('tasks.user_id', '=', $user_id_get); }
  if ($departman_id_get ) { $tasks = $tasks->where('departman.id', '=', $departman_id_get); }

  if ($start_date && $end_date) {
    $tasks = $tasks->where('tasks.updated_at', '>=', $start_date . ' 00:00:00')->where('tasks.updated_at', '<=', $end_date . ' 23:59:59');
  }

  $tasks = $tasks->orderBy('id', 'DESC')->get();
  //echo "<pre>"; print_r($tasks); die();

  
  // Kullanıcının bilgileri al
  $users=[];
  if($userRole == 'admin') {   $users = DB::table('users')->where('users.deleted_status', '=', 0)->orderBy('name', 'ASC')->get(); }
  //echo "<pre>"; print_r($users); die();


  // Kullanıcının bilgileri al
  $departmans=[];
  if($userRole == 'admin') {   $departmans = DB::table('departman')->where('departman.deleted_status', '=', 0)->orderBy('name', 'ASC')->get(); }
  //echo "<pre>"; print_r($users); die();
  
}
else {  

  $tasks = DB::table('tasks')->where('user_id', '=', $userId);
  if ($status_where != 'tüm' && $status_where != 'Arşivlenen' ) { $tasks = $tasks->where('tasks.status', '=', $status_where); }
  if ($status_where == 'Arşivlenen') { $tasks = $tasks->where('tasks.deleted_status', '=', 1); }
  else if ($status_where != 'Arşivlenen') { $tasks = $tasks->where('tasks.deleted_status', '=', 0); }

  $tasks = $tasks->orderBy('id', 'DESC')->get();

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
    <h2>Merhaba, <?= htmlspecialchars($user['name']) ?> 👋 
      <a href="<?=$base_url;?>/views/user_edit.php?id=<?= $userId ?>" class="btn btn-sm btn-warning"> Profil Düzenle</a>
    </h2>
    <p>Yapılacaklar Listesi</p>

    <div class="mb-3">
      <a href="<?=$base_url;?>/views/task_add.php" class="btn btn-success">Yeni İş Ekle</a>
      <?php if($userRole == 'admin') {  ?>  <a href="<?=$base_url;?>/views/userList.php" class="btn btn-info">Kullanıcı Listesi</a> <?php } ?>
      <a href="<?=$base_url;?>/views/logout.php" class="btn btn-danger">Çıkış Yap</a>
    </div>


    <?php if ($userRole == 'admin' ) { ?> 
      
    <form action="index.php" method="GET" style="display: flex; gap: 16px; flex-wrap: wrap; border: 1px solid #ccc; padding: 10px; width: max-content;">

      <!-- Kullanıcı Seçimi -->
      <div class="d-flex gap-3">
        <label for="user_id" class="form-label m-auto">Kullanıcı</label>
        <select name="user_id" id="user_id" class="form-control" style="cursor: pointer;">
          <option value="" <?= ($user_id_get == 0) ? 'selected' : '' ?>>Hepsi</option>
          <?php foreach ($users as $user): ?>
            <option value="<?= $user['id'] ?>" <?= ($user['id'] == $user_id_get) ? 'selected' : '' ?>>
              <?= htmlspecialchars($user['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <!-- Kullanıcı Seçimi - Son-->

      <!-- Departman Seçimi -->
      <div class="d-flex gap-3">
        <label for="departman_id" class="form-label m-auto">Departman</label>
        <select name="departman_id" id="departman_id" class="form-control" style="cursor: pointer;">
          <option value="" <?= ($departman_id_get == 0) ? 'selected' : '' ?>>Hepsi</option>
          <?php foreach ($departmans as $departman): ?>
            <option value="<?= $departman['id'] ?>" <?= ($departman['id'] == $departman_id_get) ? 'selected' : '' ?>>
              <?= htmlspecialchars($departman['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <!-- Departman Seçimi - Son-->

      <!-- Tarih Aralığı -->
      <div class="d-flex gap-3">
        <label for="start_date" class="form-label m-auto">Başlangıç</label>
        <input type="date" name="start_date" id="start_date" class="form-control" value="<?= $_GET['start_date'] ?? '' ?>">

        <label for="end_date" class="form-label m-auto">Bitiş</label>
        <input type="date" name="end_ddate" id="end_date" class="form-control" value="<?= $_GET['end_date'] ?? '' ?>">
      </div>
      <!-- Tarih Aralığı - Son -->

      <!-- Gönder Butonu -->
      <div class="d-flex align-items-center gap-3">
        <button type="submit" class="btn btn-primary">Filtrele</button>
        <a href="<?=$base_url;?>/controllers/pdf_olustur.php?user_id=<?=$user_id_get?>&&status=<?=$status_where?>&&start_date=<?=$start_date?> &&end_date=<?=$end_date?>" class="btn btn-success" target="_blank" >PDF Olarak İndir</a>
      </div>

    </form>
    
    <?php } ?>

    <br>
    <hr>


    <a href="index.php?user_id=<?=$user_id_get?>&&departman_id=<?=$departman_id_get?>&&status=tüm&&start_date=<?=$start_date?> &&end_date=<?=$end_date?>" class="btn btn-success mb-3">Tüm</a>
    <a href="index.php?user_id=<?=$user_id_get?>&&departman_id=<?=$departman_id_get?>&&start_date=<?=$start_date?> &&end_date=<?=$end_date?>" class="btn btn-warning mb-3">Devam Ediliyor</a>
    <a href="index.php?user_id=<?=$user_id_get?>&&departman_id=<?=$departman_id_get?>&&status=Planlandı&&start_date=<?=$start_date?> &&end_date=<?=$end_date?>" class="btn btn-danger mb-3">Planlandı</a>
    <a href="index.php?user_id=<?=$user_id_get?>&&departman_id=<?=$departman_id_get?>&&status=Tamamlandı&&start_date=<?=$start_date?> &&end_date=<?=$end_date?>" class="btn btn-info mb-3">Tamamlandı</a>
    <a href="index.php?user_id=<?=$user_id_get?>&&departman_id=<?=$departman_id_get?>&&status=Arşivlenen&&start_date=<?=$start_date?> &&end_date=<?=$end_date?>" class="btn btn-danger mb-3">Arşivlenen</a>

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
          <?php if($userRole == 'admin') {  ?>  <th>Adı</th> <?php } ?>
          <?php if($userRole == 'admin') {  ?>  <th>Soyadı</th> <?php } ?>
          <?php if($userRole == 'admin') {  ?>  <th>Departman</th> <?php } ?>
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
            <?php if($userRole == 'admin') {  ?>  <td><?= htmlspecialchars($task['user_surname']) ?></td> <?php } ?>
            <?php if($userRole == 'admin') {  ?>  <td><?= htmlspecialchars($task['departmanTitle']) ?></td> <?php } ?>
            <td><?= htmlspecialchars($task['title']) ?></td>
            <td><?= htmlspecialchars($task['description']) ?></td>
            <td><?= htmlspecialchars($task['status']) ?></td>
            <td><?= htmlspecialchars($task['created_at']) ?></td>
            <td><?= htmlspecialchars($task['updated_status']) ?></td>
            <td><?= htmlspecialchars($task['updated_at']) ?></td>
            <?php if($userRole == 'admin') {  ?> <td><?= htmlspecialchars($task['updated_User_name']) ?></td> <?php } ?>
            
              <td style="display: flex;gap: 3px;">
               

                <button 
                  class="btn btn-sm btn-warning"
                  data-bs-toggle="modal" 
                  data-bs-target="#editTaskModal"
                  onclick='openEditModal(<?= json_encode($task, JSON_HEX_TAG) ?>)'
                > Düzenle </button>
                              
                         
                <?php if ($status_where == 'Arşivlenen') { ?> 
                <a href="<?=$base_url;?>/controllers/task_back_controller.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-info" onclick="return confirm('Geri istediğinizden emin misiniz?');" style="width: max-content;">Geri Al</a>
                <?php } ?>

                <?php if ($status_where != 'Arşivlenen' || $userRole == 'admin' ) { ?> 
                 <button  class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $task['id'] ?>)"> Sil  </button>
                <?php } ?>
       

              </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Düzenleme Modalı -->
    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form id="editTaskForm" method="POST" action="<?=$base_url;?>/controllers/task_edit_control.php">
            <div class="modal-header">
              <h5 class="modal-title" id="editTaskModalLabel">Görev Düzenle</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" id="editTaskId">
              <input type="hidden" name="user_id" id="editUser_id">
              <div class="mb-3">
                <label for="editTitle" class="form-label">Başlık</label>
                <input type="text" class="form-control" id="editTitle" name="title" required>
              </div>
              <div class="mb-3">
                <label for="editDescription" class="form-label">Açıklama</label>
                <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
              </div>
              <!-- Durum Güncellemesi -->
              <div class="mb-3">
                <label for="editStatus" class="form-label">Durum</label>
                <select class="form-control" id="editStatus" name="status">
                  <option value="Devam Ediliyor">Devam Ediliyor</option>
                  <option value="Planlandı">Planlandı</option>
                  <option value="Tamamlandı">Tamamlandı</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
              <button type="submit" class="btn btn-primary">Kaydet</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</body>
</html>

<!--- Modal --->

<!-- Bootstrap JS + Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


<script>
function openEditModal(task) {
  console.log(task); // bu satırı ekle
  document.getElementById('editTaskId').value = task.id;
  document.getElementById('editTitle').value = task.title;
  document.getElementById('editDescription').value = task.description;
  document.getElementById('editStatus').value = task.status;
  document.getElementById('editUser_id').value = task.user_id;
}
</script>
<!--- Modal Son --->


<!--- Alert --->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(id) {
  Swal.fire({
    title: 'Emin misiniz?',
    text: "Bu işlemi geri alamazsınız!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Evet, sil!',
    cancelButtonText: 'Vazgeç'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = '<?=$base_url;?>/controllers/task_delete_controller.php?id=' + id;
    }
  });
}
</script>
<!--- Alert Son --->
