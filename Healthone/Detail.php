<?php

try {

    $db = new PDO("mysql:host=localhost;dbname=healthone",
        "mark", "root");
    $query = $db->prepare("SELECT * FROM medicijnen WHERE id = " . $_GET['id']);
    $query->bindParam("id", $_GET['id']);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as &$data) {
        echo "Artikelnummer: " . $data['id'] . "<br>";
        echo "Type: " . $data['type'] . "<br>";
        echo "Omschrijving: " . $data['omschrijving'] . "<br>";
        echo "Bijwerking: " . $data['bijwerking'] . "<br>";
    }
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>
<a href="Master.php">Terug naar de master pagina</a>
