<?php http_response_code(404); ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>404 - Sayfa Bulunamadı</title>
    <style>
        body {
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 100px;
        }
        h1 {
            font-size: 80px;
            color: #ff6b6b;
        }
        p {
            font-size: 20px;
            color: #555;
        }
        a {
            margin-top: 20px;
            display: inline-block;
            padding: 12px 24px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>404</h1>
    <p>Üzgünüz, aradığınız sayfa bulunamadı.</p>
    <a href="../../index.php">Anasayfaya Dön</a>
</body>
</html>
