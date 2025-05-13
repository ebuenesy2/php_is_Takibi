# Php Mvc İş Takibi

## Özellikler
```
* İş Takip Listesi - [ ekle / güncelle / sil / arşivle ]


* Kullanıcı - Giriş
* Kullanıcı - Giriş - Pasif Ekranı
* Kullanıcı - Listesi 
* Kullanıcı - Listesi - [ ekle / güncelle / sil / arşivle ]
* Kullanıcı - Güncelle - [ bilgiler / şifre ]


* Hata Sayfalar - 404
* Hata Sayfalar - Pasif Ekranı
* Hata Sayfalar - Yetkisiz Giriş
```

## Kurallar
```
* Kullanıcıyı Sadece admin oluşturur.
* Her Kullanıcı sadece kendi bilgilerini görebilir.
* Her Kullanıcı sadece kendi bilgilerini güncelleyebilir.
* Her Kullanıcı sadece kendi görevlerini eklebilir ve güncelleyebilir.
* Her Kullanıcı görevleri silemez.
* Sadece Admin Departman Ekleme ve Güncelleme Yapabilir.
* Sadece Admin Role Ekleme ve Güncelleme Yapabilir.
* Admin görevleri silebilebilir.
* Admin görev eklebilir.
* Admin görev kullanıcıya atama yapabilir.
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


## Hata Sayfası
```
if($user[0]['deleted_status'] == 1) {  header("Location: ../views/error/userPasif.php"); exit; }
```


## Yapılacaklar
```
* Departman Filtreleme


* İş takibi - Post

* Liste - Renklendirme
* Kullanıcı Log
* İş Log
* Kuralları Modal ve Sayfada Göster

* Zaman Filtrele
* Pdf Sayfası



*** 
Site Listesi - İndex
- Sekmesede çalıştırma
- Hoşgeldiniz sayfası
```