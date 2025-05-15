<?php


function helper_info(){

    echo "helper info";
    exit;
  
}

// function show_error($type = '404', $data = []) {
//     $errorFile = __DIR__ . '/../views/error/' . $type . '.php';
    
//     if (file_exists($errorFile)) {
//         // $data dizisini değişkenlere dönüştür (view içinde kullanabilmek için)
//         extract($data);
//         require $errorFile;
//         exit; // Hemen durdur
//     } else {
//         echo "Hata sayfası bulunamadı: $type";
//         exit;
//     }
// }
