<?php

require_once 'Database.php';


//! Log Tüm Veriler
function LogAll(){

    $dbAll = DB::table('logs')->get();
    return $dbAll;
}
//! Log Tüm Veriler Son


//! Log Ekleme
function LogAdd ($logAddData) {
    try {
        
        //! Veri Ekleme
        $dbStatus =  DB::table('logs')->insert([
            'serviceName' => $logAddData['serviceName'],
            'serviceDb' => $logAddData['serviceDb'],
            'serviceDb_Id' => $logAddData['serviceDb_Id'],
            'serviceCode' => $logAddData['serviceCode'],
            'status' => $logAddData['status'],
            'decription' => $logAddData['decription'],
            'created_byId'=> $logAddData['created_byId'],
        ]); //! Veri Ekleme Son
    
        //! Return
        $DB["title"] =  "Log Ekleme";
        $DB["status"] =  $dbStatus;
        $DB["logAddData"] =  $logAddData;

        //echo "<pre>"; print_r($DB); die();  
    
        return $DB;

    } 
	catch (\Throwable $th) { throw $th; }
}
//! Log Ekleme Son


//! Log Arama
function LogFind($conditions = []) {
    try {
        $query = DB::table('logs');
        foreach ($conditions as $col => $val) {
            $query->where($col, '=', $val);
        }
        $results = $query->get();

        return [
            'title' => 'Log Arama',
            'status' => true,
            'count' => count($results),
            'data' => $results,
           
        ];
    } catch (\Throwable $th) {
        return [
            'title' => 'Log Arama Hatası',
            'status' => false,
            'count' => 0,
            'error' => $th->getMessage()
        ];
    }
}
//! Log Arama - Son


//! Log Silme
function LogDelete($id) {
    try {
        $deleteStatus = DB::table('logs')->delete($id);

        return [
            'title'  => 'Log Silme',
            'status' => $deleteStatus,
            'id'     => $id,
        ];

    } catch (\Throwable $th) {
        return [
            'title'  => 'Log Silme Hatası',
            'status' => false,
            'error'  => $th->getMessage(),
        ];
    }
}
//! Log Silme  - Son


//! Log Çoklu Silme
function LogMultiDelete($conditions = []) {
    try {
        // Önce aranan kayıtları bul
        $logs = LogFind($conditions);

        if (!$logs['status'] || empty($logs['data'])) {
            return [
                'title' => 'Toplu Silme',
                'status' => false,
                'message' => 'Eşleşen kayıt bulunamadı.'
            ];
        }

        $deleted = [];
        foreach ($logs['data'] as $log) {
            $delete = DB::table('logs')->delete($log['id']);
            if ($delete) {
                $deleted[] = $log['id'];
            }
        }

        return [
            'title' => 'Toplu Log Silme',
            'status' => true,
            'deleted_ids' => $deleted,
            'count' => count($deleted)
        ];

    } catch (\Throwable $th) {
        return [
            'title' => 'Toplu Silme Hatası',
            'status' => false,
            'error' => $th->getMessage()
        ];
    }
}
//! Log Çoklu Silme - Son


//! Log Güncelle
function LogUpdate($conditions = [], $updateData = []) {
    try {
        // Önce eşleşen kayıtları bul
        $logs = LogFind($conditions);

        if (!$logs['status'] || empty($logs['data'])) {
            return [
                'title' => 'Toplu Güncelleme',
                'status' => false,
                'message' => 'Eşleşen kayıt bulunamadı.'
            ];
        }

        $updated = [];
        foreach ($logs['data'] as $log) {
            // Güncelleme SQL'i hazırla
            $setClause = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($updateData)));
            $sql = "UPDATE logs SET $setClause WHERE id = :id";

            $params = array_merge($updateData, ['id' => $log['id']]);
            $stmt = DB::connect()->prepare($sql);
            $status = $stmt->execute($params);

            if ($status) {
                $updated[] = $log['id'];
            }
        }

        return [
            'title' => 'Toplu Log Güncelleme',
            'status' => true,
            'updated_ids' => $updated,
            'count' => count($updated)
        ];

    } catch (\Throwable $th) {
        return [
            'title' => 'Toplu Güncelleme Hatası',
            'status' => false,
            'error' => $th->getMessage()
        ];
    }
}
//! Log Güncelle - Son


//! Login - Kontrol ve Süresi
function getBetweenTimeCalculate($tableName, $tableId, $loginCode, $logoutCode) {
    $db = DB::connect();

    // Belirtilen tablo, ID ve login/logout kodlarına göre verileri sırala
    $sql = "SELECT serviceCode, created_at 
            FROM logs 
            WHERE serviceDb = :tableName 
              AND serviceDb_Id = :tableId 
              AND serviceCode IN (:loginCode, :logoutCode)
            ORDER BY created_at ASC";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        'tableName' => $tableName,
        'tableId' => $tableId,
        'loginCode' => $loginCode,
        'logoutCode' => $logoutCode
    ]);

    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $loginTime = null;
    $loginCount = 0;
    $isOnline = false;
    $totalSeconds = 0; //! Toplam Süre
    $totalOnlineSeconds = 0; //! Toplam Online Süre
    $currentOnlineDuration = 0; //! Şimdiki Süre

    foreach ($logs as $log) {
        if ($log['serviceCode'] === $loginCode) {
            
            //echo $log['created_at']; die();

            $loginTime = strtotime($log['created_at']);
            $loginCount++;
            $isOnline = true;
        } elseif ($log['serviceCode'] === $logoutCode && $loginTime !== null) {
            
            //echo $log['created_at']; die();
            
            $logoutTime = strtotime($log['created_at']);
            $totalOnlineSeconds += ($logoutTime - $loginTime);
            $loginTime = null;
            $isOnline = false;
        }
    }


    $totalSeconds = $totalOnlineSeconds; //! Toplam Süreleri eşitledim.

    // Hâlâ online ise süreye ekle
    if ($isOnline && $loginTime !== null) {
        $currentOnlineDuration = time() - $loginTime;
        $totalSeconds += $currentOnlineDuration;
    }
      
    //!   echo "currentOnlineDuration:"; echo $currentOnlineDuration; die();

    //! Online Süre
    $hours = floor($totalOnlineSeconds / 3600);
    $minutes = floor(($totalOnlineSeconds % 3600) / 60);
    $seconds = $totalOnlineSeconds % 60;

    //! Şimdiki Süre
    $currentHours = floor($currentOnlineDuration / 3600);
    $currentMinutes = floor(($currentOnlineDuration % 3600) / 60);
    $currentSecond = $currentOnlineDuration % 60;

    //! Toplam Süre
    $totalHours = floor($totalSeconds / 3600);
    $totalMinutes = floor(($totalSeconds % 3600) / 60);
    $totalSecond = $totalSeconds % 60;

    return [
        'serviceDb' => $tableName,
        'serviceDb_Id' => $tableId,
        'loginCode' => $loginCode,
        'logoutCode' => $logoutCode,
        'loginCount' => $loginCount,
        'isOnline' => $isOnline,
        'totalOnlineTime' => sprintf('%02d saat %02d dakika %02d saniye', $hours, $minutes,$seconds),
        'currentOnlineDuration' => $isOnline ? sprintf('%02d saat %02d dakika  %02d saniye', $currentHours, $currentMinutes,$currentSecond) : null,
        'totalDuration' => $isOnline ? sprintf('%02d saat %02d dakika  %02d saniye', $totalHours, $totalMinutes,$totalSecond) : null,
    ];
}
//! Login - Kontrol ve Süresi - Son






?>