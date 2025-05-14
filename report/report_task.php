<?php
session_start();
require_once '../config/about.php';
require_once '../config/Database.php';

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


 $tasks = DB::table('tasks')
  ->join('users as user_id_user', 'tasks.user_id', '=', 'user_id_user.id')
  ->leftJoin('departman', 'departman.id', '=', 'user_id_user.departman')
  ->leftJoin('users as updated_User ', 'tasks.updated_byId', '=', 'updated_User.id')
  ->select('tasks.*', 'user_id_user.name as user_name', 'user_id_user.surname as user_surname', 'updated_User.name as updated_User_name','departman.name as departmanTitle');

  if ($status_where != 'tüm' && $status_where != 'Arşivlenen' ) { $tasks = $tasks->where('tasks.status', '=', $status_where); }
  if ($status_where == 'Arşivlenen') { $tasks = $tasks->where('tasks.deleted_status', '=', 1); }
  else if ($status_where != 'Arşivlenen') { $tasks = $tasks->where('tasks.deleted_status', '=', 0); }
  if ($user_id_get ) { $tasks = $tasks->where('tasks.user_id', '=', $user_id_get); }

  if ($start_date && $end_date) {
    $tasks = $tasks->where('tasks.created_at', '>=', $start_date . ' 00:00:00')->where('tasks.created_at', '<=', $end_date . ' 23:59:59');
  }

  $tasks = $tasks->orderBy('id', 'DESC')->get();
  //echo "<pre>"; print_r($tasks); die();


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

    <h1>Rapor</h1>
    <p>start_date: <?=$start_date ?> </p>

    <div>
        <div>Başlangıç</div>
        <div>2025-05-12</div>
    </div>
    


   
  </div>
</body>
</html>
