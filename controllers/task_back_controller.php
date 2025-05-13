<?php
session_start();
require_once '../config/Database.php';


if (!isset($_SESSION['user'])) { header("Location: ../views/loginphp"); exit; }

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

if ( count($task) > 0   && $task[0]['user_id'] != $userId && $user['role'] =='user' ) {

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Yetkiniz yoktur. - Silimezsiniz.",
    ];

    header("Location: " . $_SERVER['HTTP_REFERER']); exit;
}

if(count($task) == 0 ) { 

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Görev Bulunamadı",
    ];

    header("Location: " . $_SERVER['HTTP_REFERER']); exit;

}



// Güncelle
$deleted = DB::table('tasks')->where('id', '=', $taskId)->update([
    'deleted_status' => 0,
    'deleted_byId' => null,
    'deleted_at' => null,
    'updated_status' => 1,
    'updated_byId' => $userId,
    'updated_at' => date('Y-m-d H:i:s')
]);


if ($deleted) {
    
    $_SESSION['status'] = [
        'type'      => "success",
        'msg'      => "Görev Geri Alındı",
    ];

    header("Location: " . $_SERVER['HTTP_REFERER']); exit;

} else {

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Görev Geri Alınamadı",
    ];

    header("Location: " . $_SERVER['HTTP_REFERER']); exit;
    
}

