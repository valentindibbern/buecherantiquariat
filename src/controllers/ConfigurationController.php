<?php
declare(strict_types=1);

class ConfigurationController
{
    private DBConnection $dbConnection;
    private mysqli $connection;

    function __construct()
    {
        $this->dbConnection = new DBConnection();
        $this->connection = $this->dbConnection->getConnection();
    }

    public function configure(): void
    {
        CookieModel::configureMaxPages($this->connection);
    }

    public function getDbConnection(): DBConnection
    {
        return $this->dbConnection;
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }
}

?>
