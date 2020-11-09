<?php
try {

    $db = new PDO("mysql:host=localhost;dbname=healthone",
        "mark", "root");
    if (isset($_POST['inloggen'])) {
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        $query = $db->prepare("SELECT * FROM gebruikers
                                        WHERE username = :user AND password = :pass");
        $query->bindParam("user", $username);
        $query->bindParam("pass", $password);
        $query->execute();
        if ($query->rowCount() == 1) {
            echo "Juiste gegevens!";
        } else {
            echo "Onjuiste gegevens!";
        }
        echo "<br>";
    }
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>
<form method="post" action="">
    <label>Username</label>
    <input type="text" name="username"><br>
    <label>Password</label>
    <input type="password" name="password"><br>
    <input type="submit" name="inloggen" value="Inloggen">
</form>
