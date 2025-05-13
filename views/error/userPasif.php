<?php
session_start();
require_once '../../config/about.php';

// Örnek kontrol: Kullanıcı giriş yaptı mı ve aktif mi?
if (!isset($_SESSION['user']) || $_SESSION['user']['status'] !== 'active') {
    // Kullanıcı pasifse bu sayfa gösterilir
    http_response_code(403); // 403 Forbidden
} else {
    // Aktif kullanıcıysa başka sayfaya yönlendir
    header("Location: ../views/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Pasif</title>
    <style>
        body {
            background-color: #f3f3f3;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 100px;
        }
        .box {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            display: inline-block;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #d9534f;
        }
        p {
            color: #666;
        }
        a {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 8px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Hesabınız Pasif!</h1>
        <p>Bu hesaba erişiminiz şu anda devre dışı bırakılmıştır.<br>
           Lütfen sistem yöneticisiyle iletişime geçin.</p>
        <a href="<?=$base_url;?>/views/login.php">Giriş Sayfasına Dön</a>
    </div>
</body>
</html>
