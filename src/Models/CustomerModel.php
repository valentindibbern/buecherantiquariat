<?php
declare(strict_types=1);

namespace App\Models;

use mysqli;

class CustomerModel
{
    public static function getAllCustomers(
        mysqli $connection,
        string $search,
        string $sort,
        string $dir,
    ): array {
        switch ($sort) {
            case "vorname":
                $sort = "vorname";
                break;
            case "name":
                $sort = "name";
                break;
            case "geschlecht":
                $sort = "geschlecht";
                break;
            case "kunde_seit":
                $sort = "kunde_seit";
                break;
            case "email":
                $sort = "email";
                break;
            case "kontaktpermail":
                $sort = "kontaktpermail";
                break;
            case "geburtstag":
                $sort = "geburtstag";
                break;
            case "kid":
            default:
                $sort = "kid";
                break;
        }

        switch ($dir) {
            case "desc":
            case "DESC":
                $dir = "DESC";
                break;
            case "asc":
            case "ASC":
            default:
                $dir = "ASC";
                break;
        }

        $query = "%" . $search . "%";
        $sql = "
        SELECT * FROM kunden
        WHERE
            CAST(kid AS CHAR) LIKE ? OR
            vorname LIKE ? OR
            name LIKE ? OR
            email LIKE ?
        ORDER BY `$sort` $dir
        ";

        $statement = $connection->prepare($sql);
        $statement->bind_param("ssss", $query, $query, $query, $query);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getCustomerById(mysqli $connection, int $kid): ?array
    {
        $sql = "SELECT * FROM kunden WHERE kid = ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("i", $kid);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_assoc() ?: null;
    }

    public static function createCustomer(mysqli $connection, array $data): void
    {
        $sql = "
        INSERT INTO kunden (
            kid,
            geburtstag,
            vorname,
            name,
            geschlecht,
            kunde_seit,
            email,
            kontaktpermail
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ";

        $statement = $connection->prepare($sql);
        $kid = (int) ($data["kid"] ?? 0);
        $geburtstag = (string) ($data["geburtstag"] ?? "");
        $vorname = (string) ($data["vorname"] ?? "");
        $name = (string) ($data["name"] ?? "");
        $geschlecht = (string) ($data["geschlecht"] ?? "M");
        $kundeSeit = (string) ($data["kunde_seit"] ?? "");
        $email = (string) ($data["email"] ?? "");
        $kontaktPerMail = (int) ($data["kontaktpermail"] ?? 0);

        $statement->bind_param(
            "issssssi",
            $kid,
            $geburtstag,
            $vorname,
            $name,
            $geschlecht,
            $kundeSeit,
            $email,
            $kontaktPerMail,
        );
        $statement->execute();
    }

    public static function updateCustomer(mysqli $connection, array $data): void
    {
        $sql = "
        UPDATE kunden
        SET
            geburtstag = ?,
            vorname = ?,
            name = ?,
            geschlecht = ?,
            kunde_seit = ?,
            email = ?,
            kontaktpermail = ?
        WHERE kid = ?
        ";

        $statement = $connection->prepare($sql);
        $kid = (int) ($data["kid"] ?? 0);
        $geburtstag = (string) ($data["geburtstag"] ?? "");
        $vorname = (string) ($data["vorname"] ?? "");
        $name = (string) ($data["name"] ?? "");
        $geschlecht = (string) ($data["geschlecht"] ?? "M");
        $kundeSeit = (string) ($data["kunde_seit"] ?? "");
        $email = (string) ($data["email"] ?? "");
        $kontaktPerMail = (int) ($data["kontaktpermail"] ?? 0);

        $statement->bind_param(
            "ssssssii",
            $geburtstag,
            $vorname,
            $name,
            $geschlecht,
            $kundeSeit,
            $email,
            $kontaktPerMail,
            $kid,
        );
        $statement->execute();
    }

    public static function deleteCustomer(mysqli $connection, int $kid): void
    {
        $sql = "DELETE FROM kunden WHERE kid = ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("i", $kid);
        $statement->execute();
    }
}
