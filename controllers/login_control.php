<?php
session_start();
require_once '../config/Database.php';


// Form verilerini al
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Alan kontrolü
if (empty($email) || empty($password)) {
    header("Location: ../views/login.php?error=" . urlencode("Lütfen tüm alanları doldurun."));
    exit;
}


// Kullanıcıyı veritabanında ara
$user = DB::table('users')->where('email', '=', $email)->get();
//echo "<pre>"; print_r($user); die();

// Kullanıcı var mı ve şifresi doğru mu?
if (count($user) === 1 && password_verify($password, $user[0]['password'])) {

    
    // Oturumu başlat
    $_SESSION['user'] = [
        'status'      => $user[0]['deleted_status'] == 0 ? 'active' : 'passive',
        'id'      => $user[0]['id'],
        'name'    => $user[0]['name'],
        'surname' => $user[0]['surname'],
        'email'   => $user[0]['email'],
        'role'   => $user[0]['role'],
    ];

  
    //! Kullanıcı Pasif Sayfası - Yönlendirme
    if($user[0]['deleted_status'] == 1) {  header("Location: ../views/error/userPasif.php"); exit; }
    
    //! Anasayfa Sayfası - Yönlendirme
    header("Location: ../index.php"); exit;
    
} else {
    header("Location: ../views/login.php?error=" . urlencode("Geçersiz Giriş"));
    exit;
}
?>
