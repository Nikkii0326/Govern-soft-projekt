<?php
require "db.php"; // Csatlakozás az adatbázishoz

// JSON adatok beolvasása
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['nev'], $data['cim'], $data['tartalom'])) {
    $nev = htmlspecialchars($data['nev']);
    $cim = htmlspecialchars($data['cim']);
    $tartalom = htmlspecialchars($data['tartalom']);

    $stmt = $pdo->prepare("INSERT INTO bejegyzesek (nev, cim, tartalom) VALUES (?, ?, ?)");
    if ($stmt->execute([$nev, $cim, $tartalom])) {
        echo json_encode(["message" => "Bejegyzés sikeresen mentve!"]);
    } else {
        echo json_encode(["error" => "Hiba történt a mentés során."]);
    }
} else {
    echo json_encode(["error" => "Hiányzó adatok."]);
}
?>