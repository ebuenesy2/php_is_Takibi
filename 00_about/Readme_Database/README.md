# Database İşlemi

## Yapılması Gerekenler
```
* Dosya Oluştur [ app > Functions > Database.php ]
* Dosya Kullanımı Tanımlama Yap [ app > Http > Controllers > Admin.php ]
* Dosya Kullanımı
```

## Özellikleri
```
* Veritabanı - Ekleme
* Veritabanı - Ekleme - Son Sayısı
* Veritabanı - Sil
* Veritabanı - Güncelle
* Veritabanı - Ara - First
* Veritabanı - Ara - Get
* Veritabanı - Tüm Veriler
* Veritabanı - Count
* Veritabanı - OrderBy
* Veritabanı - Limit
* Veritabanı - Join - Inner Join ve Left Join
* Veritabanı - Json
```

## Dosya Oluştur 
```
* Yapıştır [ Database.php ]
```

## Tanım 
```
require_once 'config/Database.php';
```

## Örnek Kullanımı
```

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
    ->get();


echo "<pre>"; print_r($test); die();


?>

```

### Veri -  Ekleme
```
// Kaydet
$insert = DB::table('test')->insert([
    'title' => 'title add',
    'created_byId' => 1,
    'created_at' => date('Y-m-d H:i:s'),
]);
```

### Veri -  Ekleme - Son Id
```
// Kaydet
$insert_Id = DB::table('test')->insertGetId([
    'title' => 'title add',
    'created_byId' => 1,
    'created_at' => date('Y-m-d H:i:s'),
]);

echo "insert_Id: "; echo $insert_Id; die();
```

## Veri -   Silme
```
DB::table('test')->where('id', '=', 46)->delete();
echo "silindi";
```

## Veri -  Güncelleme
```
// Güncelle
$updated = 47;
$updated = DB::table('test')->where('id', '=', $updated)->update([
    'title' => 'title güncelle',
    'updated_status' => 1,
    'updated_byId' => 1,
    'updated_at' => date('Y-m-d H:i:s')
]);

echo "güncelle";
```


## Tüm Veriler
```
$test = DB::table('test')->get();
echo "<pre>"; print_r($test); die();
```

## Veri -   Arama
```
$test = DB::table('test')->where('updated_status', '=', 1)->get();
echo "<pre>"; print_r($test); die();
```

## Veri -   First
```
$test = DB::table('test')->where('id', '=', 48)->first();
echo "<pre>"; print_r($test); die();
```

## Tüm Veriler - Sayısı
```
$test_count = DB::table('test')->where('updated_status', '=', 1)->count();
echo "sayisi: "; echo $test_count; die();
```

## Tüm Veriler - OrderBy [ DESC => Büyükden Küçük ] [ASC => Küçükten Büyüğe ]
```
$test = DB::table('test')->where('updated_status', '=', 1)->orderBy('id', 'DESC')->get();
echo "<pre>"; print_r($test); die();
```


## Tüm Veriler - Limit
```
$page = 1; //! Sayfa 
$perPage = 3; //! Sayfa Başı
$offset = ($page - 1) * $perPage;

$test = DB::table('test')
          ->orderBy('id', 'ASC')
          ->limit($perPage)
          ->offset($offset)
          ->get();


echo "<pre>"; print_r($test); die();
```

## Tüm Veriler - Kaç Sayfa Olacağını Hesaplama
```
$total = DB::table('test')->count();
$totalPages = ceil($total / $perPage);
```

## Basit Sayfa Linkleri (örnek):
```
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<a href='?page=$i'>$i</a> ";
}
```

## Veri -  Join
```
$test = DB::table('test')
    ->join('users', 'test.created_byId', '=', 'users.id')
    ->select('test.id', 'test.title', 'users.name as user_name')
    ->where('test.deleted_status', '=', 0)
    ->get();

//echo "<pre>"; print_r($test); die();


foreach ($test as $testInfo) {
    echo $testInfo['title'] . ' - ' . $testInfo['user_name'] . '<br>';
}
```

## Veri -   Join - 2
```
$tasks = DB::table('tasks')
->join('users AS u1', 'tasks.user_id', '=', 'u1.id') // Oluşturan
->join('users AS u2', 'tasks.updated_byId', '=', 'u2.id') // Güncelleyen
->select(
	'tasks.*',
	'u1.name AS created_by_name',
	'u2.name AS updated_by_name'
)
->get();

//echo "<pre>"; print_r($tasks); die();

```

## Veri -  Left Join - InnerJoin
```

$tasks = DB::table('tasks')
->join('users as user_id_user', 'tasks.user_id', '=', 'user_id_user.id')
->leftJoin('users as updated_User ', 'tasks.updated_byId', '=', 'updated_User.id')
->select('tasks.*', 'user_id_user.name as user_name', 'updated_User.name as updated_User_name')
//->where('tasks.status', '=', 'active')
->get();

//echo "<pre>"; print_r($tasks); die();

```


## Veri -  Json Çıktı Alma
```

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
```