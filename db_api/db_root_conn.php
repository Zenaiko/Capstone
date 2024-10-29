<?php 
date_default_timezone_set('Asia/Manila');
class class_database{
    protected $pdo;
    private $host = 'localhost';
    private $user;
    private $password;
    private $database = 'db_cab_mart';

    public function __construct( $user , $password )
    {
        $this->user = $user;
        $this->password = $password;
        $this->connect();
    }
    
    private function connect(){
        $conn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
        try {
            $this->pdo = new PDO($conn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
?>