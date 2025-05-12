<?php

require_once 'Database.php';

// Form verilerini al
$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Alanlar dolu mu kontrol et
if (empty($name) || empty($email) || empty($password)) {
    header("Location: register.php?error=" . urlencode("Lütfen tüm alanları doldurun."));
    exit;
}


// E-posta daha önce kayıt olmuş mu kontrol et
$user = DB::table('users')->where('email', '=',$email)->get();
//echo "<pre>"; print_r($user); die();

// E-posta kontrolü
if (count($user) > 0) {
    header("Location: register.php?error=" . urlencode("Bu e-posta zaten kayıtlı."));
    exit;
}


// Şifreyi hashle
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// // Yeni kullanıcıyı ekle
// $userAddData = [];
// $userAddData["name"] = $name;
// $userAddData["surname"] = $surname;
// $userAddData["email"] = $email;
// $userAddData["password"] = $hashedPassword;
// $userAddData["created_byId"] = null; //? İşlemi Yapan Kişi [ 1 ] 

// //echo "<pre>"; print_r($userAddData); die(); 

    //! Veri Ekleme
    $dbStatus =  DB::table('users')->insert([
        'name' => $name,
        'surname' => $surname,
        'email' => $email,
        'password' => $hashedPassword,
        'role' => 'user',
        'created_byId'=>null,
    ]); //! Veri Ekleme Son

    //! Return
    $DB["title"] =  " Ekleme";
    $DB["status"] =  $dbStatus;

    // Başarı mesajı
    if ($dbStatus) {
        header("Location: login.php?role=user&&success=" . urlencode("Kayıt başarılı. Giriş yapabilirsiniz."));
        exit;
    } else {
        header("Location: register.php?error=" . urlencode("Kayıt başarısız. Lütfen tekrar deneyin."));
        exit;
    }
?>
