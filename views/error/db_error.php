<?php session_start(); ?>
<?php require_once '../../config/about.php'; ?>

<?php //echo "db_ERROR.php"; die(); ?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Veritabanı Hatası</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #f8f9fa;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .error-container {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            max-width: 500px;
            text-align: center;
        }

        h1 {
            font-size: 32px;
            color: #dc3545;
        }

        p {
            color: #6c757d;
            font-size: 16px;
        }

        .btn {
            margin-top: 20px;
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .code {
            margin-top: 10px;
            font-family: monospace;
            color: #495057;
            background: #f1f3f5;
            padding: 10px;
            border-radius: 6px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Veritabanı Bağlantı Hatası</h1>
        <p>Sunucu ile veritabanı arasında bağlantı kurulurken bir sorun oluştu.</p>
        <p>Lütfen daha sonra tekrar deneyin veya sistem yöneticisi ile iletişime geçin.</p>



        <!-- Geliştiriciler için hata kodu gösterimi -->
        <?php if (isset($_SESSION['statusDB']['type'])): ?>
            <div class="code"><?php echo  $_SESSION['statusDB']['msg'] ?></div>
        <?php endif; ?>

        <a href="<?=$base_url;?>">Anasayfaya Dön</a>
    </div>
</body>
</html>
