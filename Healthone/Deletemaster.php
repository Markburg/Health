<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=fietsenmaker",
        "mark", "root");
    if (isset($_GET['id'])) {
        $query = $db->prepare("DELETE FROM fietsen2 WHERE id = :id");
        $query->bindParam("id", $_GET['id']);
        if ($query->execute()) {
            echo "Het item is verwijderd.";
        } else {
            echo "Er is een fout opgetreden!";
        }
        echo "<br>";
    }
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}

$query = $db->prepare("SELECT * FROM fietsen2");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as &$data) {
    echo "<a href='Deletemaster.php?id=".$data['id']."'>";
    echo $data["merk"] . " " . $data["type"];
    echo "</a>";
    echo "<br>";
}
