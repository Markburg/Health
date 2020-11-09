<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=healthone",
        "mark", "root");

    $query = $db->prepare("SELECT * FROM medicijnen");
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as &$data) {
        echo "<a href='detail.php?id=" . $data['id'] . "'>";
        echo $data["type"];
        echo "</a>";
        echo "<br>";
    }
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>
<br>
<a href="Toevoegen.php">Producten toevoegen</a> <br>
<a href="Updatemaster.php">Producten Aanpassen</a> <br>
<a href="Deletemaster.php">Producten Verwijderen</a> <br>