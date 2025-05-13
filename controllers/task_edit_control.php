<?php
session_start();
require_once '../config/Database.php';
date_default_timezone_set('Europe/Istanbul'); //! Zaman Kontrol

if (!isset($_SESSION['user'])) {
    header("Location: ../views/login.php?error=" . urlencode("Giriş Yapınız"));
    exit;
}

$user = $_SESSION['user'];
//echo "<pre>"; print_r($user); die();

$sessionId = $user['id'];
$userRole = $user['role'];
$taskId = $_GET['id'] ?? 0;
//echo "userRole: "; echo $userRole; die();


//! Gelen Veriler

$postAll = $_POST;
//echo "<pre>"; print_r($postAll); die();

$userId = $userRole == 'admin'  ?  $_POST['user_id'] : $sessionId;
$taskId = $_POST['id'] ?? 0;
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$status = $_POST['status'] ?? 'Bekliyor';

// Güvenlik kontrolü
$task = DB::table('tasks')->where('id', '=', $taskId)->get();
//echo "<pre>"; print_r($task); die();

if (count($task) > 0 && $task[0]['user_id'] != $sessionId && $user['role'] =='user' ) {
    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Yetkiniz yoktur. - Düzenleyemezsiniz.",
    ];

    header("Location: ../index.php"); exit;
}

if(count($task) == 0 ) { 

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Görev Bulunamadı",
    ];

    header("Location: ../index.php"); exit;

}

// Güncelle
$updated = DB::table('tasks')->where('id', '=', $taskId)->update([
    'user_id' => $userId,
    'title' => $title,
    'description' => $description,
    'status' => $status,
    'updated_status' => 1,
    'updated_byId' => $sessionId,
    'updated_at' => date('Y-m-d H:i:s')
]);

if ($updated) {
    
    $_SESSION['status'] = [
        'type'      => "success",
        'msg'      => "Güncelleme Yapıldı",
    ];

    header("Location: ../index.php"); exit;

} else {

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Güncelleme Başarısız",
    ];

    header("Location: ../index.php"); exit;

}
