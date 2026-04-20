<?php
declare(strict_types=1);

class ConfigurationController
{
    private mysqli $connection;

    public function __construct() {}

    public function __destruct()
    {
        return $this->connection->close();
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    private function loadENV(): array {}

    public function configure(): bool
    {
        $envContent = FileModel::getFileContent(__DIR__ . "/../../.env.local");
        $envVars = [];

        foreach ($envContent as $line) {
            $line = trim($line);
            if (empty($line) || str_starts_with($line, "#")) {
                continue;
            }

            [$key, $value] = explode("=", $line, 2);
            $key = trim($key);
            $value = trim($value);
            $value = trim($value, '"');
            $envVars[$key] = $value;
        }
        $this->connection = new mysqli(
            (string) $envVars["DB_HOST"],
            (string) $envVars["DB_USER"],
            (string) $envVars["DB_PASSWORD"],
            (string) $envVars["DB_NAME"],
            (int) $envVars["DB_PORT"],
        );
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        CookieModel::configureMaxPages($this->connection);
    }
}

?>
