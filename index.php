<?php
session_start();
use controller\Controller;
include_once 'controller/Controller.php';
$controller = new Controller();

/* formulier met gegevens tonen om een rij bij te werken */
if(isset($_POST['showForm']))
    {
        $controller->showFormMedicijnAction( $_POST['showForm']);
    }
/* UPDATE: formulier afhandeling om een rij bij te werken */
else if(isset($_POST['update']))
    {
        $controller->updateMedicijnAction();
    }
/* CREATE:  formulier afhandeling nieuwe rij */
else if(isset($_POST['create']))
    {
        $controller->createMedicijnAction();
    }
/* DELETE:  verwijderen rijen */
else if(isset($_POST['delete']))
    {
        $controller->deletePatientAction($_POST['delete']);
    }
/*READ:  overzicht alle medicijnen */
else
    {
        $controller->readMedicijnenAction();
    }

