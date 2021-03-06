<?php


namespace model;
include_once ('model/User.php');
include_once ('model/Patient.php');
include_once ('model/Medicijn.php');
class Model
{
    private $database;

    private function makeConnection()
    {
        $this->database = new \PDO('mysql:host=localhost;dbname=healthone', "root", "");
    }
    //Register methode
    public function register($username, $password, $role) {
        $this->makeConnection();
        if (isset($_POST['register'])) {
            $query = $this->database->prepare("INSERT INTO users(id, username, password, role)
                              VALUES (NULL, :username, sha1(:password), :role)");
            $query->bindParam(":username", $username);
            $query->bindParam("password", $password);
            $query->bindParam(":role", $role);
            if ($query->execute()) {
              return true;
            }
            else {
               return false;
            }
        }
    }
    //Login methode
    public function login($username, $password){
        $this->makeConnection();
        $selection = $this->database->prepare(
            'SELECT * FROM `users`
            WHERE `users`.`username` =:username');
        $selection->bindParam(":username",$username);
        $result = $selection->execute();
        if($result) {
            $selection->setFetchMode(\PDO::FETCH_CLASS, \model\User::class);
            $user = $selection->fetch();
            if ($user) {
                $gehashtpassword = sha1($password);
                if ($user->getPassword() == $gehashtpassword) {
                    $_SESSION['user'] = $user->getUsername();
                    $_SESSION['role'] = $user->getRole();
                }
            }
        }
    }
    public function Logout(){
        session_unset();
        session_destroy();
    }
    public function insertPatient($naam,$adres,$woonplaats,$geboortedatum,$zknummer,$soortverzekering){
        $this->makeConnection();
        if($naam !='')
        {
            $query = $this->database->prepare (
                "INSERT INTO `patienten` (`id`, `naam`, `adres`, `woonplaats`, `zknummer`, `geboortedatum`, `soortverzekering`) 
                VALUES (NULL, :naam, :adres, :woonplaats, :zknummer, :geboortedatum, :soortverzekering)");
            $query->bindParam(":naam", $naam);
            $query->bindParam(":adres", $adres);
            $query->bindParam(":woonplaats",$woonplaats);
            $query->bindParam(":zknummer", $zknummer);
            $query->bindParam(":geboortedatum", $geboortedatum);
            $query->bindParam(":soortverzekering",$soortverzekering);
            $result = $query->execute();
            return $result;
        }
        return -1;
        // id hoeft niet te worden toegevoegd omdat de id in de databse op autoincrement staat.
    }
    public function updatePatient($id,$naam,$adres,$woonplaats,$geboortedatum,$zknummer,$soortverzekering){
        $this->makeConnection();
        // id moet worden toegevoegd omdat de id in de databse wordt gezocht
        $query = $this->database->prepare (
            "UPDATE `patienten` SET `naam` = :naam, `adres`=:adres, `woonplaats` = :woonplaats,
            `zknummer`=:zknummer, `geboortedatum`=:geboortedatum, `soortverzekering`=:soortverzekering 
            WHERE `patienten`.`id` = :id ");
        $query->bindParam(":id", $id);
        $query->bindParam(":naam", $naam);
        $query->bindParam(":adres", $adres);
        $query->bindParam(":woonplaats",$woonplaats);
        $query->bindParam(":zknummer", $zknummer);
        $query->bindParam(":geboortedatum", $geboortedatum);
        $query->bindParam(":soortverzekering",$soortverzekering);
        $result = $query->execute();
        return $result;
    }
    public function getPatienten(){
        $this->makeConnection();
        $selection = $this->database->query('SELECT * FROM `patienten`');
        if($selection){
            $result=$selection->fetchAll(\PDO::FETCH_CLASS,\model\Patient::class);
            return $result;
        }
        return null;
    }
    public function selectPatient($id){
        $this->makeConnection();
        $selection = $this->database->prepare(
            'SELECT * FROM `patienten` 
            WHERE `patienten`.`id` =:id');
        $selection->bindParam(":id",$id);
        $result = $selection ->execute();
        if($result){
            $selection->setFetchMode(\PDO::FETCH_CLASS, \model\Patient::class);
            $patient = $selection->fetch();
            return $patient;
        }
        return null;
    }
    public function deletePatient($id){
        $this->makeConnection();
        $selection = $this->database->prepare(
            'DELETE FROM `patienten` 
            WHERE `patienten`.`id` =:id');
        $selection->bindParam(":id",$id);
        $result = $selection ->execute();
        return $result;
    }
    public function insertMedicijn($type, $omschrijving, $bijwerking)
    {
        $this->makeConnection();
        if ($type != '') {
            $query = $this->database->prepare(
                "INSERT INTO `medicijnen` (`id`, `type`, `omschrijving`, `bijwerking`) 
                VALUES (NULL, :type, :omschrijving, :bijwerking)");
            $query->bindParam(":type", $type);
            $query->bindParam(":omschrijving", $omschrijving);
            $query->bindParam(":bijwerking", $bijwerking);
            $result = $query->execute();
            return $result;
        }
        return -1;
        // id hoeft niet te worden toegevoegd omdat de id in de databse op autoincrement staat.
    }

    public function updateMedicijn($id, $type, $omschrijving, $bijwerking){
        $this->makeConnection();
        // id moet worden toegevoegd omdat de id in de databse wordt gezocht
        $query = $this->database->prepare (
            "UPDATE `medicijnen` SET `type` = :type, `omschrijving`=:omschrijving, `bijwerking` = :bijwerking
            WHERE `medicijnen`.`id` = :id ");
        $query->bindParam(":id", $id);
        $query->bindParam(":type", $type);
        $query->bindParam(":omschrijving", $omschrijving);
        $query->bindParam(":bijwerking",$bijwerking);
        $result = $query->execute();
        return $result;
    }

    public function getMedicijnen()
    {

        $this->makeConnection();
        $selection = $this->database->query('SELECT * FROM `medicijnen`');
        if ($selection) {
            $result = $selection->fetchAll(\PDO::FETCH_CLASS, \model\Medicijn::class);
            return $result;
        }
        return null;
    }

    public function selectMedicijn($id)
    {

        $this->makeConnection();
        $selection = $this->database->prepare(
            'SELECT * FROM `medicijnen` 
            WHERE `medicijnen`.`id` =:id');
        $selection->bindParam(":id", $id);
        $result = $selection->execute();
        if ($result) {
            $selection->setFetchMode(\PDO::FETCH_CLASS, \model\Medicijn::class);
            $medicijn = $selection->fetch();
            return $medicijn;
        }
        return null;
    }

    public function deleteMedicijn($id)
    {
        $this->makeConnection();
        $selection = $this->database->prepare(
            'DELETE FROM `medicijnen` 
            WHERE `medicijnen`.`id` =:id');
        $selection->bindParam(":id", $id);
        $result = $selection->execute();
        return $result;
    }
    public function insertGebruiker($username, $password, $role)
    {
        $this->makeConnection();
        if ($username != '') {
            $query = $this->database->prepare(
                "INSERT INTO `users` (`id`, `username`, `password`, `role`) 
                VALUES (NULL, :username, :password, :role)");
            $query->bindParam(":username", $username);
            $query->bindParam(":password", $password);
            $query->bindParam(":role", $role);
            $result = $query->execute();
            return $result;
        }
        return -1;
        // id hoeft niet te worden toegevoegd omdat de id in de databse op autoincrement staat.
    }

    public function updateGebruiker($id, $username, $password, $role){
        $this->makeConnection();
        // id moet worden toegevoegd omdat de id in de databse wordt gezocht
        $query = $this->database->prepare (
            "UPDATE `users` SET `username` = :username, `password`=:password, `role` = :role
            WHERE `users`.`id` = :id ");
        $query->bindParam(":id", $id);
        $query->bindParam(":username", $username);
        $query->bindParam(":password", $password);
        $query->bindParam(":role",$role);
        $result = $query->execute();
        return $result;
    }

    public function getGebruiker()
    {

        $this->makeConnection();
        $selection = $this->database->query('SELECT * FROM `users`');
        if ($selection) {
            $result = $selection->fetchAll(\PDO::FETCH_CLASS, \model\User::class);
            return $result;
        }
        return null;
    }

    public function selectGebruiker($id)
    {

        $this->makeConnection();
        $selection = $this->database->prepare(
            'SELECT * FROM `users` 
            WHERE `users`.`id` =:id');
        $selection->bindParam(":id", $id);
        $result = $selection->execute();
        if ($result) {
            $selection->setFetchMode(\PDO::FETCH_CLASS, \model\User::class);
            $user = $selection->fetch();
            return $user;
        }
        return null;
    }

    public function deleteGebruiker($id)
    {
        $this->makeConnection();
        $selection = $this->database->prepare(
            'DELETE FROM `users` 
            WHERE `users`.`id` =:id');
        $selection->bindParam(":id", $id);
        $result = $selection->execute();
        return $result;
    }
    public function getDokters()
    {

        $this->makeConnection();
        $selection = $this->database->query('SELECT * FROM `users` WHERE role ="dokter"');
        if ($selection) {
            $result = $selection->fetchAll(\PDO::FETCH_CLASS, \model\User::class);
            return $result;
        }
        return null;
    }
    public function getApothekers()
    {

        $this->makeConnection();
        $selection = $this->database->query('SELECT * FROM `users` WHERE role ="apotheker"');
        if ($selection) {
            $result = $selection->fetchAll(\PDO::FETCH_CLASS, \model\User::class);
            return $result;
        }
        return null;
    }
}