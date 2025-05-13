<?php
session_start();
require_once '../config/Database.php';
date_default_timezone_set('Europe/Istanbul'); //! Zaman Kontrol

if (!isset($_SESSION['user'])) { header("Location: ../views/login.php?error=" . urlencode("Giriş Yapınız")); exit; }

$user = $_SESSION['user'];
//echo "<pre>"; print_r($user); die();

$sessionId = $user['id'];
$userRole = $user['role'];


//! Gelen Veriler
$postAll = $_POST;
//echo "<pre>"; print_r($postAll); die();

$userId = $userRole == 'admin'  ?  $sessionId : $_POST['id'];
$user_Get_Id = $_POST['id'] ?? 0;
$password = $_POST['password'] ?? '';
$newpassword = $_POST['newpassword'] ?? '';
$renewpassword = $_POST['renewpassword'] ?? '';


if($newpassword != $renewpassword) {

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Sifreler Uyuşmuyor",
    ];

    if($user['role'] =='admin') { header("Location: ../views/userList.php"); exit;    }
    if($user['role'] =='user') { header("Location: ../index.php"); exit; }

}


//! Kullanıcı Bilgileri
$userFind = DB::table('users')->where('id', '=', $user_Get_Id)->get();
//echo "<pre>"; print_r($userFind); die();

if (count($userFind) == 0 || ( count($userFind) == 1 && password_verify($password, $userFind[0]['password']) == 0 ) ) {  
  
    $_SESSION['status'] = [
      'type'      => "error",
      'msg'      => "Kullanıcı Bulunamadı",
    ];

    if($user['role'] =='admin') { header("Location: ../views/userList.php"); exit;    }
    if($user['role'] =='user') { header("Location: ../index.php"); exit; }
  }



// Güncelle
$updated = DB::table('users')->where('id', '=', $user_Get_Id)->update([
    'password' => password_hash($newpassword, PASSWORD_DEFAULT),
    'updated_status' => 1,
    'updated_byId' => $sessionId,
    'updated_at' => date('Y-m-d H:i:s')
]);


if ($updated) {
    
    $_SESSION['status'] = [
        'type'      => "success",
        'msg'      => "Şifre Güncelleme Yapıldı",
    ];

    if($user['role'] =='admin') { header("Location: ../views/userList.php"); exit;    }
    if($user['role'] =='user') { header("Location: ../index.php"); exit; }

} else {

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Şifre Güncelleme Başarısız",
    ];

    if($user['role'] =='admin') { header("Location: ../views/userList.php"); exit;    }
    if($user['role'] =='user') { header("Location: ../index.php"); exit; }

}
