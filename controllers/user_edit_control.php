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
$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$email = $_POST['email'] ?? '';
$user_departman = $_POST['user_departman'] ?? 0;
$user_role = $_POST['user_role'] ?? 'user';

//! Kullanıcı Bilgileri
$userFind = DB::table('users')->where('id', '=', $user_Get_Id)->get();
//echo "<pre>"; print_r($userFind); die();


if (count($userFind) == 0 ) {  
  
    $_SESSION['status'] = [
      'type'      => "error",
      'msg'      => "Kullanıcı Bulunamadı",
    ];

    if($user['role'] =='admin') { header("Location: ../views/userList.php"); exit;    }
    if($user['role'] =='user') { header("Location: ../index.php"); exit; }
  }

//! Yetki Kontrol
if($user['role'] == 'user' && $userId != $user_Get_Id ) { echo "Başka bir kullanıcıyı güncelleme yetkiniz yoktur"; die();  }


// Ortak güncellenen alanlar
$updateData = [
    'name'           => $name,
    'surname'        => $surname,
    'email'          => $email,
    'role'           => $user_role,
    'updated_status' => 1,
    'updated_byId'   => $sessionId,
    'updated_at'     => date('Y-m-d H:i:s')
];

// Sadece admin ise departman güncellenir
if ($user['role'] === 'admin') {
    $updateData['departman'] = $user_departman;
}

// Güncelleme işlemi
$updated = DB::table('users')->where('id', '=', $user_Get_Id)->update($updateData);


if ($updated) {



    if($user['role'] == 'user' && $userId != $user_Get_Id ) {

        // Session Bilgileri
        $_SESSION['user'] = [
            'id' => $user_Get_Id,
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'departman' => $user_departman,
            'role' => $user_role,
        ];

    }
    
    $_SESSION['status'] = [
        'type'      => "success",
        'msg'      => "Güncelleme Yapıldı",
    ];

    if($user['role'] =='admin') { header("Location: ../views/userList.php"); exit;    }
    if($user['role'] =='user') { header("Location: ../index.php"); exit; }

} else {

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Güncelleme Başarısız",
    ];

    if($user['role'] =='admin') { header("Location: ../views/userList.php"); exit;    }
    if($user['role'] =='user') { header("Location: ../index.php"); exit; }

}
