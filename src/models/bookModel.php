<?php
class BookModel
{
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
        $pageSize,
    ) {
        $offset = ($page - 1) * $pageSize;

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
        zustand LIKE ?
        LIMIT ? OFFSET ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "iiisiiisisii",
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
            $pageSize,
            $offset,
        );
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
