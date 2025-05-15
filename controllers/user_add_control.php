<?php
session_start();
require_once '../config/Database.php';


//! Tüm Veriler
$postAll = $_POST;
//echo "<pre>"; print_r($postAll); die();

// Form verilerini al
$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$user_departman = $_POST['user_departman'] ?? 0;
$user_role = $_POST['user_role'] ?? 'user';

if($_POST['password'] != $_POST['repassword'] ) { 
    
    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Sifreler Uyuşmuyor",
    ];

    header("Location: ../views/user_add.php"); exit;

}
else {

   
    // E-posta daha önce kayıt olmuş mu kontrol et
    $user = DB::table('users')->where('email', '=',$email)->get();
    //echo "<pre>"; print_r($user); die();

    // E-posta kontrolü
    if (count($user) > 0) { 
       
        $_SESSION['status'] = [
            'type'      => "error",
            'msg'      => "Bu e-posta zaten kayıtlıdır.",
        ];

        header("Location: ../views/user_add.php"); exit;

    }


    // Şifreyi hashle
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //! Veri Ekleme
    $dbStatus =  DB::table('users')->insert([
        'name' => $name,
        'surname' => $surname,
        'email' => $email,
        'password' => $hashedPassword,
        'departman' => $user_departman,
        'role' => $user_role,
        'created_byId'=>null,
    ]); //! Veri Ekleme Son

    //! Return
    $DB["title"] =  " Ekleme";
    $DB["status"] =  $dbStatus;

    // Başarı mesajı
    if ($dbStatus) {
        
        $_SESSION['status'] = [
            'type'      => "success",
            'msg'      => "Kayıt Başarı İle Kayıt Edildi.",
        ];

        header("Location: ../views/userList.php"); exit;

        // if($user_role == 'user') { header("Location: ../views/login.php?role=user");  exit; }
        // if($user_role == 'admin') { header("Location: ../views/login.php");  exit; }

    } else {

         
        $_SESSION['status'] = [
            'type'      => "error",
            'msg'      => "Kayıt başarısız. Lütfen tekrar deneyin.",
        ];

        header("Location: ../views/user_add.php"); exit;

    }

}


?>
