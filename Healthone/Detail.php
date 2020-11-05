<?php

$db = new PDO("mysql:host=localhost;dbname=fietsenmaker",
    "mark", "root");
$query = $db->prepare("SELECT * FROM fietsen2 WHERE id = " . $_GET['id']);

$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as &$data) {
    echo "Artikelnummer: " . $data['id'] . "<br>";
    echo "Merk: " . $data['merk'] . "<br>";
}
