<?php
require_once 'config/Database.php';


// Güncelle
$updated_id = 47; //! Güncellenecek id

// Ortak güncellenen alanlar
$updateData = [
    'title'           => 'title deneme',
    'updated_status' => 1,
    'updated_byId'   => 15,
    'updated_at'     => date('Y-m-d H:i:s')
];

//! Sonradan ekleme durumu
$updateData['name'] = "name user";

// Güncelleme işlemi
$updated = DB::table('test')->where('id', '=', $updated_id)->update($updateData);


echo "güncelle";

?>