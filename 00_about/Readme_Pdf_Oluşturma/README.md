# Php - Pdf Oluşturma



## Pdf Oluştma Button - İndex.php
```
<a href="<?=$base_url;?>/controllers/pdf_olustur.php" class="btn btn-success" >PDF Olarak İndir</a>
```

## Pdf Oluştma - Controller [ controllers/pdf_olustur.php ]
```
include("../report/report_task.php"); //! Export Alanıcak Sayfa
```

## Export Alanıcak Sayfa [report/pdf_example.php ]
```
* Tasarım Bu sayfada yapılacak
```

## Export Yapılmayacak - Html
```
<p class="no-print" >Export Yapılmayacak</p>
```


## Export Yapılmayacak - CSS
```
  <style>
      .no-print { display: block; }

      @media print {
          .no-print { display: none !important; }
      }
  </style>
```
