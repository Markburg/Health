<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=fietsenmaker",
        "mark", "root");
    if (isset($_POST['verzenden'])) {
    $merk = $_POST['merk'];
    $type = $_POST['type'];
    $prijs = $_POST['prijs'];
    $query = $db->prepare("INSERT INTO fietsen2(merk, type, prijs)
    VALUES (:merk, :type, :prijs)");

    $query->bindParam("merk", $merk);
    $query->bindParam("type", $type);
    $query->bindParam("prijs", $prijs);
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
    <label>Merk</label>
    <input type="text" name="merk"> <br>
    <label>Type</label>
    <input type="text" name="type"> <br>
    <label>Prijs</label>
    <input type="text" name="prijs"> <br>

    <input type="submit" name="verzenden" value="Opslaan">
</form>
