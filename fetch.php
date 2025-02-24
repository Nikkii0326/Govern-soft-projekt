<?php
require "db.php"; 

header("Content-Type: application/json; charset=UTF-8");

try {
    $stmt = $pdo->query("SELECT id, nev, cim, tartalom, datum FROM bejegyzesek ORDER BY datum DESC");
    $bejegyzesek = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($bejegyzesek, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo json_encode(["error" => "Adatbázis hiba: " . $e->getMessage()]);
}
?>