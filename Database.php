<?php
class DB {
    private static $conn;
    private $table;

    // Veritabanına bağlan
    public static function connect() {
        if (!self::$conn) {
            try {
                $host = "localhost";
                $dbname = "is_takibi";
                $username = "root";
                $password = "";

                self::$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                die("Bağlantı hatası: " . $e->getMessage());
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
    

    
    //! Where Ara
    private $wheres = []; // where koşullarını tutmak için

    public function where($column, $operator, $value) {
        $this->wheres[] = [$column, $operator, $value];
        return $this;
    }

    // Tüm verileri getir
    public function get() {
        $sql = "SELECT " . implode(', ', $this->selects) . " FROM {$this->table}";
    
        if (!empty($this->joins)) {
            $sql .= ' ' . implode(' ', $this->joins);
        }
    
        if (!empty($this->wheres)) {
            $whereClauses = array_map(function($w) {
                return "{$w[0]} {$w[1]} ?";
            }, $this->wheres);
    
            $sql .= " WHERE " . implode(" AND ", $whereClauses);
        }
    
        $stmt = self::$conn->prepare($sql);
    
        $values = array_map(function($w) {
            return $w[2];
        }, $this->wheres);
    
        $stmt->execute($values);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    

    // Veri ekle
    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Veri sil
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Verileri güncelle
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

  



}
?>
