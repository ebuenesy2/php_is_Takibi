<?php
require_once 'config/Database.php';

$test = DB::table('tasks')
    ->join('users', 'tasks.user_id', '=', 'users.id')
    ->select('tasks.id', 'tasks.title', 'users.name as user_name','users.departman')
    //->where('test.deleted_status', '=', 0)
    ->orderBy('departman', 'ASC')
    ->groupBy('departman')
    ->get();
    //->get(true); // true = JSON olarak döne


echo "<pre>"; print_r($test); die();


// JSON'u diziye çevir
$data = json_decode($test, true);
echo "<pre>"; print_r($data); die();
echo "id:"; echo $data[0]['id']; die();

?>