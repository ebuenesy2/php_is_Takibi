<?php http_response_code(403); // 403 Forbidden ?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yetkiniz Yok</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 80px;
        }
        .card {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            display: inline-block;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 48px;
            color: #dc3545;
        }
        p {
            font-size: 18px;
            color: #555;
        }
        button {
            margin-top: 25px;
            padding: 12px 24px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Yetkiniz Yok!</h1>
        <p>Bu sayfayı görüntülemek için yeterli yetkiye sahip değilsiniz.</p>
        <button onclick="history.back()">Geri Dön</button>
    </div>
</body>
</html>
