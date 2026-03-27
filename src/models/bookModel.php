<?php
declare(strict_types=1);

class BookModel
{
    public static function getTotalPages($conn): int
    {
        $sql = "SELECT COUNT(*) FROM buecher";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        return (int) $row[0];
    }

    public static function getBooksByPage($conn, $page): array
    {
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

    public static function searchBooks(
        $conn,
        $page,
        $strquery,
        $id,
        $katalog,
        $nummer,
        $kategorie,
        $verkauft,
        $kaufer,
        $verfasser,
        $zustand,
    ): array {
        $strsearchQuery = "%$strquery%";
        $idsearchQuery = "%$id%";
        $katalogsearchQuery = "%$katalog%";
        $nummersearchQuery = "%$nummer%";
        $kategorisearchQuery = "%$kategorie%";
        $verkauftsearchQuery = "%$verkauft%";
        $kaufersearchQuery = "%$kaufer%";
        $verfassersearchQuery = "%$verfasser%";
        $zustandsearchQuery = "%$zustand%";

        $sql = "
        SELECT * FROM buecher WHERE
        id LIKE ? OR
        katalog LIKE ? OR
        nummer LIKE ? OR
        Title LIKE ? OR
        kategorie LIKE ? OR
        verkauft LIKE ? OR
        kaufer LIKE ? OR
        autor LIKE ? OR
        verfasser LIKE ? OR
        zustand LIKE ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "iiisiiisis",
            $idsearchQuery,
            $katalogsearchQuery,
            $nummersearchQuery,
            $strsearchQuery,
            $kategorisearchQuery,
            $verkauftsearchQuery,
            $strqueryQuery,
            $kaufersearchQuery,
            $verfassersearchQuery,
            $zustandsearchQuery,
        );
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
