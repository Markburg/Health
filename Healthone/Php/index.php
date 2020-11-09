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
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="all"/>
    <meta name="language" content="Dutch">
    <meta name="Author" content="Mark Van Den Burg">
    <meta name="description" content="Healthone website">
    <meta name="keywords" content="Doktoren, medicijnen apothekers">

    <link rel="stylesheet" href="../Css/Main.css">
    <title>Health One</title>
</head>
    <body>
        <nav id="nav">
            <a href="index.php"><img id="Home" src="Images/Logo.PNG" alt=""></a>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="Registreren.php">Registreren</a></li>
                <li><a href="Contact.php">Contact</a></li>
            </ul>
            <form id="Login" method="post" action="">
                <label>Gebruikersnaam:</label>
                <input type="text" name="username"><br>
                <label>Wachtwoord:</label>
                <input type="password" name="password"><br>
                <input id="Inloggen" type="submit" name="inloggen" value="Inloggen">
            </form>
        </nav>
    </body>
</html>