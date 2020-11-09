<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=healthone",
        "mark", "root");
    if (isset($_POST['verzenden'])) {
        $type = $_POST['type'];
        $omschrijving = $_POST['omschrijving'];
        $bijwerking = $_POST['bijwerking'];
    $query = $db->prepare("INSERT INTO medicijnen(type, omschrijving, bijwerking)
    VALUES (:type, :omschrijving, :bijwerking)");

    $query->bindParam("type", $type);
    $query->bindParam("omschrijving", $omschrijving);
    $query->bindParam("bijwerking", $bijwerking);
    if ($query->execute()) {
        echo "De nieuwe gegevens zijn toegevoegd.";
    }else {
        echo "Er is een fout opgetreden!";
    }
    echo "<br>";
    }
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>

<form method="post" action="">
    <label>Type</label>
    <input type="text" name="type"> <br>
    <label>Omschrijving</label>
    <input type="text" name="omschrijving"> <br>
    <label>Bijwerking</label>
    <input type="text" name="bijwerking"> <br>

    <input type="submit" name="verzenden" value="Opslaan">
</form>
