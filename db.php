<?php

class Database {
    /*
    private $host = 'localhost';
    private $db_name = 'room_raccoon';
    private $username = 'root';
    private $password = '';
    public $conn;
    */
    
    private $host = 'sql112.infinityfree.com';
    private $db_name = 'if0_37025930_room_raccoon';
    private $username = 'if0_37025930';
    private $password = 'iT0A05p8p4';
    public $conn;
    
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
