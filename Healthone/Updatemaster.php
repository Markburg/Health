<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=healthone",
        "mark", "root");
    $query = $db->prepare("SELECT * FROM medicijnen");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as &$data) {
    echo "<a href='Updatedetail.php?id=".$data['id']."'>";
    echo $data["type"];
    echo "</a>";
    echo "<br>";
    }
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}


