<?php
namespace controller;
include_once "view/View.php";
use view\View;
include_once "model/Medicijn.php";
use model\Model;

class Controller
{
    private $view;
    private $model;
    public function __construct(){
        $this->model = new Model();
        $this->view = new View($this->model);
    }
    public function readMedicijnenAction(){
        $this->view->showMedicijnen();
    }

    public function showFormMedicijnAction($id=null){
       $this->view->showFormMedicijnen($id);
    }
    public function createMedicijnAction(){
        $type = filter_input(INPUT_POST,'type');
        $omschrijving = filter_input(INPUT_POST,'omschrijving');
        $bijwerking = filter_input(INPUT_POST,'bijwerking');
        $result = $this->model->insertMedicijn($type,$omschrijving,$bijwerking);
        $this->view->showMedicijnen($result);
    }
    public function updateMedicijnAction(){
        $id = filter_input(INPUT_POST,'id');
        $type = filter_input(INPUT_POST,'type');
        $omschrijving = filter_input(INPUT_POST,'omschrijving');
        $bijwerking = filter_input(INPUT_POST,'bijwerking');
        $result=$this->model->updateMedicijn($id,$type,$omschrijving,$bijwerking);
        $this->view->showMedicijnen($result);
    }
    public function deletePatientAction($id){
        $result = $this->model->deleteMedicijn($id);
        $this->view->showMedicijnen($result);
    }
}