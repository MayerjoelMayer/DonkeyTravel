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
        $conn = new PDO($dsn, $this->user, $this->pass);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        if ($conn) {
            return $conn;
        } else {
            echo "Connection failed";
        }
    }
    public function getBooking()
    {
        $sql = "SELECT * FROM bookings";
        $result = $this->connect()->query($sql);
        return $result;
    }
    
}


    