<?php


namespace model;
include_once ('model/User.php');
class Loginmethode
{
    private $database;

    private function makeConnection(){
        $this->database = new \PDO('mysql:host=localhost;dbname=healthone', "root", "");
    }

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
                $gehashtpassword = strtoupper(hash("sha256", $password));
                //var_dump($gehashtpassword);
                if ($user->getPassword() == $gehashtpassword) {
                    $_SESSION['user'] = $user->getUsername();
                    $_SESSION['role'] = $user->getRole();
                }
            }
        }
    }
}
