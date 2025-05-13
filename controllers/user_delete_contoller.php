<?php
session_start();
require_once '../config/Database.php';

if (!isset($_SESSION['user'])) { header("Location: ../views/login.php"); exit; }

$user = $_SESSION['user'];
//echo "<pre>"; print_r($user); die();

$userId = $user['id'];
$userRole = $user['role'];
//echo "userRole: "; echo $userRole; die();


//! Gelen Veri
$user_Get_Id = $_GET['id'] ?? 0;
//echo "user_Get_Id:"; echo $user_Get_Id; die();


// Güvenlik kontrolü: sadece kendi görevini silebilir
$userFind = DB::table('users')->where('id', '=', $user_Get_Id)->get();
//echo "<pre>"; print_r($userFind); die();


// Sil
if( count($userFind) > 0 && $userFind[0]['deleted_status'] == 1 && $user['role'] =='admin') { $deleted = DB::table('users')->where('id','=',$user_Get_Id)->delete(); }
if( count($userFind) > 0 && $userFind[0]['deleted_status'] == 0 ) {

    // Güncelle
    $deleted = DB::table('users')->where('id', '=', $user_Get_Id)->update([
        'deleted_status' => 1,
        'deleted_byId' => $userId,
        'deleted_at' => date('Y-m-d H:i:s'),
        'updated_status' => 1,
        'updated_byId' => $userId,
        'updated_at' => date('Y-m-d H:i:s')
    ]);

}
if(count($userFind) == 0 ) { 

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Kullanıcı Bulunamadı",
    ];

    if($user['role'] =='admin') { header("Location: ../views/userList.php"); exit;    }
    if($user['role'] =='user') { header("Location: ../index.php"); exit; }

}


if ($deleted && $userFind[0]['deleted_status'] == 1 && $user['role'] =='admin') {
    
    $_SESSION['status'] = [
        'type'      => "success",
        'msg'      => "Kullanıcı Silindi",
    ];

    if($user['role'] =='admin') { header("Location: ../views/userList.php"); exit;    }

}
else if ($deleted && $userFind[0]['deleted_status'] == 0) {
    
    if($user['role'] =='admin') { 
        $_SESSION['status'] = [ 'type' => "success", 'msg' => "Kullanıcı Arşivlendi", ];
        header("Location: ../views/userList.php"); exit;    
    }
    if($user['role'] =='user') { 
     $_SESSION['status'] = [ 'type'  => "success", 'msg' => "Kullanıcı Silindi", ];
     header("Location: ../views/login.php"); exit; 
    }

}else {

    $_SESSION['status'] = [
        'type'      => "error",
        'msg'      => "Kullanıcı Silinemedi",
    ];

    if($user['role'] =='admin') { header("Location: ../views/userList.php"); exit;    }
    if($user['role'] =='user') { header("Location: ../index.php"); exit; }
    
}

