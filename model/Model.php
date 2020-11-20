<?php


namespace model;
include_once ('model/User.php');
include_once ('model/Medicijn.php');
class Model
{
    private $database;

    private function makeConnection()
    {
        $this->database = new \PDO('mysql:host=localhost;dbname=healthone', "root", "");
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
                //$gehashtpassword = strtoupper(hash("sha256", $password));
                $gehashtpassword = $password;
                //var_dump($gehashtpassword);
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

    public function updateMedicijn($id, $type, $omschrijving, $bijwerking)
    {
        $this->makeConnection();

        // id moet worden toegevoegd omdat de id in de databse wordt gezocht
        $query = $this->database->prepare(
            "UPDATE `medicijnen` SET `type` = :type, `omschrijving`=:omschrijving, `bijwerking` = :bijwerking,
            WHERE `medicijnen`.`id` = :id ");
        $query->bindParam(":id", $id);
        $query->bindParam(":type", $type);
        $query->bindParam(":omschrijving", $omschrijving);
        $query->bindParam(":bijwerking", $bijwerking);
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
}