<?php
session_start();
require_once '../config/Database.php';

if (!isset($_SESSION['user'])) { header("Location: ../views/login.php"); exit; };

$user = $_SESSION['user'];
//echo "<pre>"; print_r($user); die();

$userId = $user['id'];
$userRole = $user['role'];
//echo "userRole: "; echo $userRole; die();

//! Gelen Veri
$taskId = $_GET['id'] ?? 0;
// echo "taskId:"; echo $taskId; die();

// Güvenlik kontrolü: sadece kendi görevini silebilir
$task = DB::table('tasks')->where('id', '=', $taskId)->get();
//echo "<pre>"; print_r($task); die();

if (!$task || $task[0]['user_id'] != $userId && $user['role'] =='user' ) {

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Yetkiniz yoktur. - Silimezsiniz.",
    ];

    header("Location: ../index.php"); exit;
}



// Sil
if($task[0]['deleted_status'] == 1 && $user['role'] =='admin') { $deleted = DB::table('tasks')->delete($taskId); }
if( $task[0]['deleted_status'] == 0 ) {

    // Güncelle
    $deleted = DB::table('tasks')->where('id', '=', $taskId)->update([
        'deleted_status' => 1,
        'deleted_byId' => $userId,
        'deleted_at' => date('Y-m-d H:i:s'),
        'updated_status' => 1,
        'updated_byId' => $userId,
        'updated_at' => date('Y-m-d H:i:s')
    ]);

}


if ($deleted) {
    
    $_SESSION['status'] = [
        'type'      => "success",
        'msg'      => "Görev Silindi",
    ];

    header("Location: " . $_SERVER['HTTP_REFERER']); exit;

} else {

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Görev Silinemedi",
    ];

    header("Location: " . $_SERVER['HTTP_REFERER']); exit;
    
}

