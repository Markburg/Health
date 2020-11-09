<?php
try {

    $db = new PDO("mysql:host=localhost;dbname=healthone",
        "mark", "root");
    if (isset($_POST['verzenden'])) {
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        $query = $db->prepare("INSERT INTO gebruikers(username, password)
    VALUES (:username, :password)");
        $query->bindParam("username", $username);
        $query->bindParam("password", $password);
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
    <label>Gebruikersnaam</label>
    <input type="text" name="username"> <br>
    <label>Wachtwoord</label>
    <input type="text" name="password"> <br>

    <input type="submit" name="verzenden" value="Registreren">
</form>
