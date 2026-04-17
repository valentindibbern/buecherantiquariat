<?php
declare(strict_types=1);

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
        $pageSize = 18;
        $offset = ($page - 1) * $pageSize;
        $sql = "SELECT * FROM buecher ORDER BY `$sort` $dir LIMIT ? OFFSET ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("ii", $pageSize, $offset);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getBookById(mysqli $connection, int $id): array
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
}
?>
