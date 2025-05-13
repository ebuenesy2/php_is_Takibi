<?php
session_start();
require_once '../config/Database.php';

if (!isset($_SESSION['user'])) { header("Location: ../views/login.php"); exit; } 

$sessionId = $_SESSION['user']['id'];

$postAll = $_POST;
//echo "<pre>"; print_r($postAll); die();

// Form verileri
$userId = $_POST['user_id'] ?? $sessionId;
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$status = $_POST['status'] ?? 'Bekliyor';

//echo "userId: "; echo $userId; die();

if (empty($title) || empty($description)) {

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Eksik Bilgiler Var.",
    ];

    header("Location: ../index.php?error=" . urlencode("Eksik Bilgiler Var."));
    exit;
}

// Kaydet
$insert = DB::table('tasks')->insert([
    'user_id' => $userId,
    'title' => $title,
    'description' => $description,
    'status' => $status,
    'created_byId' => $sessionId,
    'created_at' => date('Y-m-d H:i:s'),
]);


if ($insert) {
    
    $_SESSION['status'] = [
        'type'      => "success",
        'msg'      => "Görev Eklendi",
    ];

    header("Location: ../index.php"); exit;

} else {

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Görev Eklenemedi",
    ];

    header("Location: ../index.php"); exit;
    
}

