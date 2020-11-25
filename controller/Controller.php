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
    public function Home() {
        $this->view->homePage();
    }
    public function loginAction(){
        if (isset($_POST['username']) && isset($_POST['password'])){
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');
            $this->model->login($username, $password);

            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                $this->view->showMedicijnen();
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
        if (isset($_POST['username']) && isset($_POST['password'])&& isset($_POST['role'])) {
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');
            $role = filter_input(INPUT_POST, 'role');
            $this->model->register($username, $password, $role);

            if (isset($_SESSION[!'role']) && $_SESSION['role'] !== 'admin') {
                $this->view->showRegister();
            } else {
                $this->view->showLogin();
            }
        }
    }
    public function logoutAction() {
        $this->model->Logout();
        $this->view->showLogin();
    }

    public function readMedicijnenAction()
    {
        $this->view->showMedicijnen();
    }

    public function showFormMedicijnAction($id = null)
    {
        $this->view->showFormMedicijnen($id);
    }

    public function createMedicijnAction()
    {
        $type = filter_input(INPUT_POST, 'type');
        $omschrijving = filter_input(INPUT_POST, 'omschrijving');
        $bijwerking = filter_input(INPUT_POST, 'bijwerking');
        $result = $this->model->insertMedicijn($type, $omschrijving, $bijwerking);
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
}