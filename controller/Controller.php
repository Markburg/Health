<?php
namespace controller;
include_once "view/View.php";
use view\View;
include_once "model/User.php";
include_once "model/Medicijn.php";
use model\Model;

class Controller
{
    private $view;
    private $model;

    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View($this->model);
    }
    public function loginAction(){
        if (isset($_POST['username']) && isset($_POST['password'])){
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');
            $this->model->login($username, $password);

            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                $this->view->showPatienten();
                $this->view->showUsers();
                $this->view->showMedicijnen();
            }else if (isset($_SESSION['role']) && $_SESSION['role'] === 'dokter') {
                $this->view->showPatienten();
                $this->view->showMedicijnen();
            } else if (isset($_SESSION['role']) && $_SESSION['role'] === 'patiënt'){
                $this->view->showDokters();
                $this->view->showApothekers();
            }
            else {
                $this->view->showLogin();
            }
        } else {
            $this->view->showLogin();
        }
    }
    public function registerButton(){
        {
            $this->view->showRegister();
        }
    }
    public function registerAction()
    {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');
            $role = filter_input(INPUT_POST, 'role');
            $registerSuccesfull = $this->model->register($username, $password, $role);

            if ($registerSuccesfull === false) {
                $message = "kies een andere gebruikersnaam";
                $this->view->showRegister($message);
            }
            else {
                $message = "Succesvol geregistreerd u kunt nu inloggen";
                $this->view->showLogin($message);
            }
        }
    }
    public function logoutAction() {
        $this->model->Logout();
        $this->view->showLogin();
    }
    public function readPatientenAction(){
        $this->view->showPatienten();
    }

    public function showFormPatientAction($id=null){
        $this->view->showFormPatienten($id);
    }
    public function createPatientAction(){
        $naam = filter_input(INPUT_POST,'naam');
        $adres = filter_input(INPUT_POST,'adres');
        $woonplaats = filter_input(INPUT_POST,'woonplaats');
        $geboortedatum = filter_input(INPUT_POST,'geboortedatum');
        $soortverzekering = filter_input(INPUT_POST,'soortverzekering');
        $zknummer = filter_input(INPUT_POST,'zknummer');
        $result = $this->model->insertPatient($naam,$adres,$woonplaats,$geboortedatum,$zknummer,$soortverzekering);
        $this->view->showPatienten($result);
    }
    public function updatePatientAction(){
        $id = filter_input(INPUT_POST,'id');
        $naam = filter_input(INPUT_POST,'naam');
        $adres = filter_input(INPUT_POST,'adres');
        $woonplaats = filter_input(INPUT_POST,'woonplaats');
        $geboortedatum = filter_input(INPUT_POST,'geboortedatum');
        $zknummer = filter_input(INPUT_POST,'zknummer');
        $soortverzekering = filter_input(INPUT_POST,'soortverzekering');
        $result = $this->model->updatePatient($id,$naam,$adres,$woonplaats,$geboortedatum,$zknummer,$soortverzekering);
        $this->view->showPatienten($result);
    }
    public function deletePatientAction($id){
        $result = $this->model->deletePatient($id);
        $this->view->showPatienten($result);
    }

    public function readMedicijnenAction()
    {
        $this->view->showMedicijnen();
    }

    public function showFormMedicijnAction($id = null)
    {
        $this->view->showFormMedicijnen($id);
    }

    public function createMedicijnaction(){
        $type = filter_input(INPUT_POST,'type');
        $omschrijving = filter_input(INPUT_POST,'omschrijving');
        $bijwerking = filter_input(INPUT_POST,'bijwerking');
        $result = $this->model->insertMedicijn($type,$omschrijving,$bijwerking);
        $this->view->showMedicijnen($result);
    }

    public function updateMedicijnAction()
    {
        $id = filter_input(INPUT_POST, 'id');
        $type = filter_input(INPUT_POST, 'type');
        $omschrijving = filter_input(INPUT_POST, 'omschrijving');
        $bijwerking = filter_input(INPUT_POST, 'bijwerking');
        $result = $this->model->updateMedicijn($id, $type, $omschrijving, $bijwerking);
        $this->view->showMedicijnen($result);
    }

    public function deleteMedicijnAction($id)
    {
        $result = $this->model->deleteMedicijn($id);
        $this->view->showMedicijnen($result);
    }

    public function readUsersaction()
    {
        $this->view->showUsers();
    }

    public function showFormUsersaction($id = null)
    {
        $this->view->showFormUsers($id);
    }

    public function createUsersaction(){
        $username = filter_input(INPUT_POST,'username');
        $password = filter_input(INPUT_POST,'password');
        $role = filter_input(INPUT_POST,'role');
        $result = $this->model->insertGebruiker($username,$password,$role);
        $this->view->showUsers($result);
    }

    public function updateUsersaction()
    {
        $id = filter_input(INPUT_POST, 'id');
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $role = filter_input(INPUT_POST, 'role');
        $result = $this->model->updateGebruiker($id, $username, $password, $role);
        $this->view->showUsers($result);
    }

    public function deleteUsersaction($id)
    {
        $result = $this->model->deleteGebruiker($id);
        $this->view->showUsers($result);
    }
    public function readDoktersaction() {
        $this->view->showDokters();
    }
    public function readApothekersaction() {
        $this->view->showDokters();
    }
}
