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
$user_Get_Id = $_GET['id'] ?? 0;
//echo "user_Get_Id:"; echo $user_Get_Id; die();

//! Kullanıcı Bilgileri
$userFind = DB::table('users')->where('id', '=', $user_Get_Id)->get();
//echo "<pre>"; print_r($userFind); die();

if(count($userFind) == 0 ) { 

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Kullanıcı Bulunamadı",
    ];

    if($user['role'] =='admin') { header("Location: ../views/userList.php"); exit;    }
    if($user['role'] =='user') { header("Location: ../index.php"); exit; }

}


if (count($userFind) == 0  && $userFind[0]['id'] != $userId || $user['role'] =='user' ) { 

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Yetkiniz yoktur. - Silimezsiniz.",
    ];

    header("Location: " . $_SERVER['HTTP_REFERER']); exit;
}



// Güncelle
$deleted = DB::table('users')->where('id', '=', $user_Get_Id)->update([
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
        'msg'      => "Kullanıcı Geri Alındı",
    ];

    header("Location: " . $_SERVER['HTTP_REFERER']); exit;

} else {

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Kullanıcı Geri Alınamadı",
    ];

    header("Location: " . $_SERVER['HTTP_REFERER']); exit;
    
}

