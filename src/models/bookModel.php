<?php
declare(strict_types=1);

namespace App\Models;
use mysqli;

class BookModel
{
    public static function getTotalPages(mysqli $connection): int
    {
        $sql = "SELECT COUNT(*) FROM buecher";
        $result = $connection->query($sql);
        $row = $result->fetch_row();
        return (int) ceil($row[0] / 18);
    }

    public static function getBooksByPage(
        mysqli $connection,
        int $page,
        string $sort,
        string $dir,
    ): array {
        switch ($sort) {
            case "Title":
            case "title":
            case "Titel":
            case "titel":
                $sort = "Title";
                break;
            case "Autor":
            case "autor":
                $sort = "autor";
                break;
            case "Zustand":
            case "zustand":
                $sort = "zustand";
                break;
            default:
                $sort = "Title";
        }

        switch ($dir) {
            case "ASC":
            case "asc":
                $dir = "ASC";
                break;
            case "DESC":
            case "desc":
                $dir = "DESC";
                break;
            default:
                $dir = "ASC";
        }

        $pageSize = 18;
        $offset = ($page - 1) * $pageSize;
        $sql = "SELECT * FROM buecher ORDER BY `$sort` $dir LIMIT ? OFFSET ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("ii", $pageSize, $offset);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getBookById(mysqli $connection, int $id): ?array
    {
        $sql = "SELECT * FROM buecher WHERE id = ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_assoc();
    }

    public static function searchBooks(mysqli $connection, string $query): array
    {
        $query = "%$query%";

        $sql = "
        SELECT * FROM buecher WHERE
        Title LIKE ? OR
        autor LIKE ? OR
        zustand LIKE ?";

        $statement = $connection->prepare($sql);

        $statement->bind_param("sss", $query, $query, $query);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getAllBooks(mysqli $connection): array
    {
        $sql = "SELECT * FROM buecher";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getAdminBooks(
        mysqli $connection,
        string $search,
        string $sort,
        string $dir,
    ): array {
        switch ($sort) {
            case "Title":
            case "title":
                $sort = "Title";
                break;
            case "autor":
                $sort = "autor";
                break;
            case "zustand":
                $sort = "zustand";
                break;
            case "nummer":
                $sort = "nummer";
                break;
            case "katalog":
                $sort = "katalog";
                break;
            case "id":
            default:
                $sort = "id";
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
        SELECT * FROM buecher
        WHERE
            CAST(id AS CHAR) LIKE ? OR
            CAST(nummer AS CHAR) LIKE ? OR
            Title LIKE ? OR
            autor LIKE ? OR
            Beschreibung LIKE ?
        ORDER BY `$sort` $dir
        ";

        $statement = $connection->prepare($sql);
        $statement->bind_param("sssss", $query, $query, $query, $query, $query);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function createBook(mysqli $connection, array $data): void
    {
        $sql = "
        INSERT INTO buecher (
            katalog,
            nummer,
            Title,
            kategorie,
            verkauft,
            kaufer,
            autor,
            Beschreibung,
            foto,
            verfasser,
            zustand
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";

        $statement = $connection->prepare($sql);
        $katalog = (int) ($data["katalog"] ?? 0);
        $nummer = (int) ($data["nummer"] ?? 0);
        $title = (string) ($data["title"] ?? "");
        $kategorie = (int) ($data["kategorie"] ?? 0);
        $verkauft = (int) ($data["verkauft"] ?? 0);
        $kaufer = (int) ($data["kaufer"] ?? 0);
        $autor = (string) ($data["autor"] ?? "");
        $beschreibung = (string) ($data["beschreibung"] ?? "");
        $foto = (string) ($data["foto"] ?? "");
        $verfasser = (int) ($data["verfasser"] ?? 0);
        $zustand = (string) ($data["zustand"] ?? "");

        $statement->bind_param(
            "iisiiisssis",
            $katalog,
            $nummer,
            $title,
            $kategorie,
            $verkauft,
            $kaufer,
            $autor,
            $beschreibung,
            $foto,
            $verfasser,
            $zustand,
        );
        $statement->execute();
    }

    public static function updateBook(mysqli $connection, array $data): void
    {
        $sql = "
        UPDATE buecher
        SET
            katalog = ?,
            nummer = ?,
            Title = ?,
            kategorie = ?,
            verkauft = ?,
            kaufer = ?,
            autor = ?,
            Beschreibung = ?,
            foto = ?,
            verfasser = ?,
            zustand = ?
        WHERE id = ?
        ";

        $statement = $connection->prepare($sql);
        $id = (int) ($data["id"] ?? 0);
        $katalog = (int) ($data["katalog"] ?? 0);
        $nummer = (int) ($data["nummer"] ?? 0);
        $title = (string) ($data["title"] ?? "");
        $kategorie = (int) ($data["kategorie"] ?? 0);
        $verkauft = (int) ($data["verkauft"] ?? 0);
        $kaufer = (int) ($data["kaufer"] ?? 0);
        $autor = (string) ($data["autor"] ?? "");
        $beschreibung = (string) ($data["beschreibung"] ?? "");
        $foto = (string) ($data["foto"] ?? "");
        $verfasser = (int) ($data["verfasser"] ?? 0);
        $zustand = (string) ($data["zustand"] ?? "");

        $statement->bind_param(
            "iisiiisssisi",
            $katalog,
            $nummer,
            $title,
            $kategorie,
            $verkauft,
            $kaufer,
            $autor,
            $beschreibung,
            $foto,
            $verfasser,
            $zustand,
            $id,
        );
        $statement->execute();
    }

    public static function deleteBook(mysqli $connection, int $id): void
    {
        $sql = "DELETE FROM buecher WHERE id = ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("i", $id);
        $statement->execute();
    }
}
?>
