<?php
session_start();
use controller\Controller;
include_once 'controller/Controller.php';
$controller = new Controller();

//alleen deze acties uitvoeren als er ingelogd is en de gebruiker admin is!!!
if(isset($_SESSION['role']) && $_SESSION['role']=="admin") {
    //Gebruikers
    if (isset($_POST['showFormusers'])) {
        $controller->showFormUsersaction($_POST['showFormusers']);
    } /* UPDATE: formulier afhandeling om een rij bij te werken */
    else if (isset($_POST['updateUser'])) {
        $controller->updateUsersaction();
    } /* CREATE:  formulier afhandeling nieuwe rij */
    else if (isset($_POST['createUser'])) {
        $controller->createUsersaction();
    } /* DELETE:  verwijderen rijen */
    else if (isset($_POST['deleteUsers'])) {
        $controller->deleteUsersaction($_POST['deleteUsers']);
    }
    //Patienten
    /* formulier met gegevens tonen om een rij bij te werken */
    if (isset($_POST['showFormpatient'])) {
        $controller->showFormPatientAction($_POST['showFormpatient']);
    } /* UPDATE: formulier afhandeling om een rij bij te werken */
    else if (isset($_POST['updatepatient'])) {
        $controller->updatePatientAction();
    } /* CREATE:  formulier afhandeling nieuwe rij */
    else if (isset($_POST['createpatient'])) {
        $controller->createPatientAction();
    } /* DELETE:  verwijderen rijen */
    else if (isset($_POST['deletepatient'])) {
        $controller->deletePatientAction($_POST['deletepatient']);
    }
    //Medicijnen
    if (isset($_POST['showForm'])) {
        $controller->showFormMedicijnAction($_POST['showForm']);
    } /* UPDATE: formulier afhandeling om een rij bij te werken */
    else if (isset($_POST['update'])) {
        $controller->updateMedicijnAction();
    } /* CREATE:  formulier afhandeling nieuwe rij */
    else if (isset($_POST['create'])) {
        $controller->createMedicijnAction();
    } /* DELETE:  verwijderen rijen */
    else if (isset($_POST['delete'])) {
        $controller->deleteMedicijnAction($_POST['delete']);
    } else if (isset($_POST['logout'])) {
        $controller->logoutAction();
    } /*READ:  overzicht alle */
    else {
        $controller->readPatientenAction();
        $controller->readMedicijnenAction();
        $controller->readUsersaction();
    }
    //alleen deze actie uitvoeren als er ingelogd is en de gebruiker dokter is!!!!
}   else if (isset($_SESSION['role']) && $_SESSION['role'] == "dokter") {
    //Patienten
    /* formulier met gegevens tonen om een rij bij te werken */
    if (isset($_POST['showFormpatient'])) {
        $controller->showFormPatientAction($_POST['showFormpatient']);
    } /* UPDATE: formulier afhandeling om een rij bij te werken */
    else if (isset($_POST['updatepatient'])) {
        $controller->updatePatientAction();
    } /* CREATE:  formulier afhandeling nieuwe rij */
    else if (isset($_POST['createpatient'])) {
        $controller->createPatientAction();
    } /* DELETE:  verwijderen rijen */
    else if (isset($_POST['deletepatient'])) {
        $controller->deletePatientAction($_POST['deletepatient']);
    }
    //Medicijnen
    if (isset($_POST['showForm'])) {
        $controller->showFormMedicijnAction($_POST['showForm']);
    } /* UPDATE: formulier afhandeling om een rij bij te werken */
    else if (isset($_POST['update'])) {
        $controller->updateMedicijnAction();
    } /* CREATE:  formulier afhandeling nieuwe rij */
    else if (isset($_POST['create'])) {
        $controller->createMedicijnAction();
    } /* DELETE:  verwijderen rijen */
    else if (isset($_POST['delete'])) {
        $controller->deleteMedicijnAction($_POST['delete']);
    } else if (isset($_POST['logout'])) {
        $controller->logoutAction();
    } /*READ:  overzicht alle */
    else {
        $controller->readPatientenAction();
        $controller->readMedicijnenAction();
    }
} else if (isset($_SESSION['role']) && $_SESSION['role'] == "patiënt") {
     if (isset($_POST['logout'])) {
        $controller->logoutAction();
     }
     else {
         $controller->readDoktersaction();
         $controller->readApothekersaction();
     }
}
else {
    if(!isset($_POST['register'])){
        $controller->loginAction();
    }

}
if (isset($_POST['registerbutton']))
{
    $controller->registerButton();

}
if (isset($_POST['register'])) {
    $controller->registerAction();
}