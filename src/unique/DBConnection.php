<?php
class DBConnection
{
    private string $host = "127.0.0.1";
    private string $dbname = "books";
    private string $username = "root";
    private string $password = "";
    private int $port = 3307;
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->dbname,
            $this->port,
        );
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    public function __destruct()
    {
        $this->connection->close();
    }
}
