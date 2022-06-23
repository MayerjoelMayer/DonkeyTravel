<?php
class connect
{
    
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "donkey_travel";
    public function connect()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $pdo = new PDO($dsn, $this->user, $this->pass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        if ($pdo) {
            return $pdo;
        } else {
            echo "Connection failed";
        }
    }
    public function gettochten()
    {
        $sql = "SELECT * FROM tochten";
        $result = $this->connect()->query($sql);
        return $result;
    }
    
}


    