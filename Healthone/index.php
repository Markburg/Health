<?php
$db = new PDO("mysql:host=localhost;dbname=fietsenmaker",
"mark", "root");

$query = $db->prepare("SELECT * FROM fietsen2");
$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as &$data) {
    echo $data["merk"]. " ";
    echo $data["type"]. " ";
    echo $data["prijs"]. "<br> ";
}