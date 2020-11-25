<?php
try {
    $db = new \PDO('mysql:host=localhost;dbname=healthone', "root", "");

    if (isset($_POST['registreren'])) {
        $username= $_POST['username'];
        $password= $_POST['password'];
        $role= $_POST['role'];

        $query = $db->prepare("INSERT INTO users(id, username, password, role)
                              VALUES (NULL, :username, sha1(:password), :role)");
        $query->bindParam("username", $username);
        $query->bindParam("password", $password);
        $query->bindParam("role", $role);
        if ($query->execute()) {
            echo "nieuwe gebruiker toegevoegd";
        }
        else {
            echo "Error";
        } echo "<br>";
    }
} catch (PDOException $e) {
    die("Error!: ". $e->getMessage());
}
?>

<form method="post" action="">
    <label>gebruikersnaam</label>
    <input type="text" name="username"><br>

    <label>Wachtwoord</label>
    <input type="text" name="password"><br>

    <label>Rol</label>
    <input type="text" name="role"><br>

    <input type="submit" name="registreren" value="Opslaan">
</form>
