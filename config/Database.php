<?php
require_once 'about.php'; //! Bilgiler
//echo  "host:"; echo $host; die();

class DB {
    
    private static $base_url; //! Site Url
  
    //! Veri Tabanı Bilgileri
    private static $conn = null;
    private static $host;
    private static $dbname;
    private static $userName;
    private static $pass;

    private $table;

    // Veritabanı ayarlarını otomatik olarak al
    private static function loadConfig() {
        global $base_url,$host, $dbname, $userName, $pass;

        self::$base_url = $base_url;

        self::$host = $host;
        self::$dbname   = $dbname;
        self::$userName = $userName;
        self::$pass = $pass;
    }
    
    // Veritabanına bağlan
    public static function connect() { 
        if (self::$conn === null) {
            self::loadConfig(); // Sayfa çalışınca config otomatik alınır

            //echo "dbname -"; echo self::$userName; echo "-v"; die(); 
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8mb4";

            try {
                self::$conn = new PDO($dsn, self::$userName, self::$pass);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                //die("Veritabanı bağlantı hatası: " . $e->getMessage());

                $_SESSION['statusDB'] = [
                    'type'      => "error",
                    'msg'      => $e->getMessage(),
                ];

                header("Location:".self::$base_url."/views/error/db_error.php"); exit;
            }
        }
        return self::$conn;
    }

    // Tablo seç
    public static function table($tableName) {
        return new static($tableName);
    }

    private function __construct($tableName) {
        $this->table = $tableName;
        self::connect();
    }


    //! Join
    private $joins = [];

    public function leftJoin($table, $first, $operator, $second) {
        return $this->join($table, $first, $operator, $second, 'LEFT');
    }
    
    public function join($table, $first, $operator, $second, $type = 'INNER') {
        $this->joins[] = strtoupper($type) . " JOIN $table ON $first $operator $second";
        return $this;
    }

    //! Select
    private $selects = ['*'];
    
    public function select(...$columns) {
        $this->selects = $columns;
        return $this;
    }
    

    //! First - Ara
    public function first() {
        $result = $this->get();
        return $result[0] ?? null;
    }


    //! Count - Sayısı
    public function count() {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        
        if (!empty($this->wheres)) {
            $whereClauses = array_map(fn($w) => "{$w[0]} {$w[1]} ?", $this->wheres);
            $sql .= " WHERE " . implode(" AND ", $whereClauses);
        }

        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array_column($this->wheres, 2));
        
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;
    }


    //! OrderBy ve Limit
    private $orderBy;
    private $limit;
    private $offset;

    public function orderBy($column, $direction = 'ASC') {
        $this->orderBy = "$column $direction";
        return $this;
    }

    public function limit($number) {
        $this->limit = (int)$number;
        return $this;
    }
    

    public function offset($number) {
        $this->offset = (int)$number;
        return $this;
    }
    //! OrderBy ve Limit --- Son

    
    //! Where Ara
    private $wheres = []; // where koşullarını tutmak için

    public function where($column, $operator, $value) {
        $this->wheres[] = [$column, $operator, $value];
        return $this;
    }
    //! Where Ara -- Son

    // Tüm verileri 
    public function get($asJson = false) {
        $sql = "SELECT " . implode(', ', $this->selects) . " FROM {$this->table}";

        if (!empty($this->joins)) {
            $sql .= ' ' . implode(' ', $this->joins);
        }

        if (!empty($this->wheres)) {
            $whereClauses = array_map(fn($w) => "{$w[0]} {$w[1]} ?", $this->wheres);
            $sql .= " WHERE " . implode(" AND ", $whereClauses);
        }

        if ($this->orderBy) {
            $sql .= " ORDER BY " . $this->orderBy;
        }

        if ($this->limit) {
            $sql .= " LIMIT " . $this->limit;
        }

        if ($this->offset) {
            $sql .= " OFFSET " . $this->offset;
        }

        $stmt = self::$conn->prepare($sql);

        $values = array_map(fn($w) => $w[2], $this->wheres);
        $stmt->execute($values);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $asJson ? json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : $results;
    }
    // Tüm veriler - Son

    


    // Veri Ekle
    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute($data);
    }
    // Veri Ekle  -- Son

    
    //! Veri Ekle - Son Id
    public function insertGetId($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = self::$conn->prepare($sql);

        if ($stmt->execute($data)) {
            return self::$conn->lastInsertId(); // 💡 Son eklenen ID
        }

        return false;
    }
    //! Veri Ekle - Son Id -- Son

    // Veri Sil
    public function delete() {
        if (empty($this->wheres)) {
            throw new Exception("Silme işlemi için 'where' koşulu gereklidir.");
        }

        $whereClauses = [];
        foreach ($this->wheres as $index => $w) {
            $whereClauses[] = "{$w[0]} {$w[1]} :where_{$index}";
        }

        $sql = "DELETE FROM {$this->table} WHERE " . implode(" AND ", $whereClauses);
        $stmt = self::$conn->prepare($sql);

        foreach ($this->wheres as $index => $w) {
            $stmt->bindValue(":where_{$index}", $w[2]);
        }

        return $stmt->execute();
    }
    // Veri Sil -- Son

    // Verileri Güncelle
    public function update($data) {
        if (empty($this->wheres)) {
            throw new Exception("Güncelleme işlemi için 'where' koşulu gereklidir.");
        }

        $setClauses = [];
        foreach ($data as $column => $value) {
            $setClauses[] = "$column = :$column";
        }

        $sql = "UPDATE {$this->table} SET " . implode(", ", $setClauses);

        // WHERE koşullarını ekle
        $whereClauses = [];
        foreach ($this->wheres as $index => $w) {
            $whereClauses[] = "{$w[0]} {$w[1]} :where_{$index}";
        }
        $sql .= " WHERE " . implode(" AND ", $whereClauses);

        $stmt = self::$conn->prepare($sql);

        // Değerleri bağla
        foreach ($data as $column => $value) {
            $stmt->bindValue(":$column", $value);
        }
        foreach ($this->wheres as $index => $w) {
            $stmt->bindValue(":where_{$index}", $w[2]);
        }

        return $stmt->execute();
    }
    // Verileri Güncelle -- Son

  



}
?>
