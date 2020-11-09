<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=healthone",
        "mark", "root");
    if (isset($_POST['verzenden'])) {
        $type = $_POST['type'];
        $omschrijving = $_POST['omschrijving'];
        $bijwerking = $_POST['bijwerking'];

        $query = $db->prepare("UPDATE medicijnen SET type = :type,
        omschrijving = :omschrijving,
        bijwerking = :bijwerking
        WHERE id = :id");
        $query->bindParam("type", $type);
        $query->bindParam("omschrijving", $omschrijving);
        $query->bindParam("bijwerking", $bijwerking);
        $query->bindParam("id", $_GET['id']);
        if ($query->execute()) {
            echo "De nieuwe gegevens zijn toegevoegd.";
        } else {
            echo "Er is een fout opgetreden!";
        }
        echo "<br>";
    } else {
        $query = $db->prepare("SELECT * FROM medicijnen WHERE id = :id");
        $query->bindParam("id", $_GET['id']);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as &$data) {
            $type = $data["type"];
            $omschrijving = $data["omschrijving"];
            $bijwerking = $data["bijwerking"];
        }
    }
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>

<form method="post" action="">
    <label>Type</label>
    <input type="text" name="type" value="<?php echo $type; ?>"><br>
    <label>Omschrijving</label>
    <input type="text" name="omschrijving" value="<?php echo $omschrijving; ?>"><br>
    <label>Bijwerkingen</label>
    <input type="text" name="bijwerking" value="<?php echo $bijwerking; ?>"><br>

    <input type="submit" name="verzenden" value="Opslaan">
</form>
