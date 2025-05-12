<?php
session_start();
require_once 'Database.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit;
}

$user = $_SESSION['user'];
//echo "<pre>"; print_r($user); die();

$userId = $user['id'];
$userRole = $user['role'];
$taskId = $_GET['id'] ?? 0;
//echo "userRole: "; echo $userRole; die();

$taskId = $_GET['id'] ?? 0;

// Güvenlik kontrolü: sadece kendi görevini silebilir
$task = DB::table('tasks')->where('id', '=', $taskId)->get();
//echo "<pre>"; print_r($task); die();

if (!$task || $task[0]['user_id'] != $userId && $user['role'] =='user' ) {

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Yetkiniz yoktur. - Silimezsiniz.",
    ];

    header("Location: " . $_SERVER['HTTP_REFERER']); exit;
}



// Güncelle
$deleted = DB::table('tasks')->where('id', '=', $taskId)->update([
    'deleted_status' => 0,
    'deleted_byId' => null,
    'deleted_at' => null,
    'updated_status' => 1,
    'updated_byId' => $sessionId,
    'updated_at' => date('Y-m-d H:i:s')
]);


if ($deleted) {
    
    $_SESSION['status'] = [
        'type'      => "success",
        'msg'      => "Görev Silindi",
    ];

    header("Location: index.php"); exit;

} else {

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Görev Silinemedi",
    ];

    header("Location: index.php"); exit;
    
}

