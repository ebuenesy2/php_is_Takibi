<?php
require_once 'config/Database.php';

// Kaydet
$insert_Id = DB::table('test')->insertGetId([
    'title' => 'title add',
    'created_byId' => 1,
    'created_at' => date('Y-m-d H:i:s'),
]);

echo "insert_Id: "; echo $insert_Id; die();


?>