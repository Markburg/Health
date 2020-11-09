<?php
try {

    $db = new PDO("mysql:host=localhost;dbname=healthone",
        "mark", "root");
    $query = $db->prepare("SELECT * FROM gebruikers WHERE id = " . $_GET['id']);
    $query->bindParam("id", $_GET['id']);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as &$data) {
        echo "gebruiker: " . $data['id'] . "<br>";
        echo "Naam: " . $data['username'] . "<br>";
        echo "Wachtwoord: " . $data['password'] . "<br>";
        echo "Rol: " . $data['rol'] . "<br>";
    }
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>
<a href="index.php">Terug naar de Home pagina</a>

