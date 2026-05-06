<?php
declare(strict_types=1);

namespace App\Controllers;

use mysqli;

class ConfigurationController
{
    private mysqli $connection;

    public function configure(): void
    {
        $this->createConst($this->createENV($this->loadENV()));
        $this->connection = $this->createConnection();
        $this->createSession();
        \App\Models\CookieModel::configureMaxPages($this->connection);
    }

    private function createSession(): void
    {
        session_set_cookie_params([
            "path" => (string) SESSION_COOKIE_PATH,
            "secure" => (bool) SESSION_COOKIE_SECURE,
            "httponly" => (bool) SESSION_COOKIE_HTTPONLY,
        ]);

        session_start();
    }

    private function loadENV(): array
    {
        return \App\Models\FileModel::getFileContent(__DIR__ . "/../../.env.local");
    }

    private function createENV(array $envContent): array
    {
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

        return $envVars;
    }

    private function createConst(array $values): void
    {
        foreach ($values as $key => $value) {
            define($key, $value);
        }
    }

    private function createConnection(): \mysqli
    {
        $connection = new mysqli(
            (string) DB_HOST,
            (string) DB_USER,
            (string) DB_PASSWORD,
            (string) DB_NAME,
            (int) DB_PORT,
        );

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        return $connection;
    }

    public function __destruct()
    {
        return $this->connection->close();
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }
}