<?php
require_once 'config/Database.php';


$page = 2; //! Sayfa 
$perPage = 3; //! Sayfa Başı
$offset = ($page - 1) * $perPage;

$test = DB::table('test')
    ->join('users', 'test.created_byId', '=', 'users.id')
    ->select('test.id', 'test.title', 'users.name as user_name')
    ->where('test.deleted_status', '=', 0)
    ->orderBy('id', 'ASC')
    ->limit($perPage)
    ->offset($offset)
    //->get();
    ->get(true); // true = JSON olarak döne


//echo "<pre>"; print_r($test); die();


// JSON'u diziye çevir
$data = json_decode($test, true);
//echo "<pre>"; print_r($data); die();
echo "id:"; echo $data[0]['id']; die();


?>