<?php
class DBConnection
{
    private $host = "127.0.0.1";
    private $dbname = "books";
    private $username = "root";
    private $password = "";
    private $port = 3307;
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->dbname,
            $this->port,
        );
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function connect()
    {
        return $this->conn;
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
