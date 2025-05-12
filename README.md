# php_is_Takibi

## Yapılması Gereken
```
* Veri Tabanı Ekle
```

## Site Bilgileri Alma
```
<?php require_once '../config/about.php'; ?>
<?php echo $base_url; die(); ?>
```
```
action="<?=$base_url;?>/controllers/login_control.php" 
```

```
action="../controllers/task_edit_control.php"
```

## Veri Tabanı
```
require_once '../config/Database.php';
```


## Sayfalar
```
header("Location: ../index.php");
```