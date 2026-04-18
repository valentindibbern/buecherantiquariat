<?php
declare(strict_types=1);

class UserModel
{
    public static function userExists(
        mysqli $connection,
        string $username,
    ): bool {
        $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        return $row["COUNT(*)"] > 0;
    }

    public static function getPassword(
        mysqli $connection,
        string $username,
    ): ?string {
        $sql = "SELECT password FROM users WHERE username = ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        return $row["password"] ?? null;
    }
}

?>
