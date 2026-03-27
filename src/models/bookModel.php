<?php
declare(strict_types=1);

class BookModel
{
    public static function getTotalPages($conn): int
    {
        $sql = "SELECT COUNT(*) FROM buecher";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        return (int) ceil($row[0] / 18);
    }

    public static function getBooksByPage($conn, $page): array
    {
        $pageSize = 18;
        $offset = ($page - 1) * 18;
        $sql = "SELECT * FROM buecher LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $pageSize, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getBookById($conn, $id): array
    {
        $sql = "SELECT * FROM buecher WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public static function searchBooks($conn, $query): array
    {
        $query = "%$query%";

        $sql = "
        SELECT * FROM buecher WHERE
        Title LIKE ? OR
        autor LIKE ? OR
        zustand LIKE ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sss", $query, $query, $query);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
