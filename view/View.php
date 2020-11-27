<?php
namespace view;
include_once ('model/Model.php');
include_once ('model/User.php');
include_once('model/Medicijn.php');

class View
{

    private $model;
    public function __construct($model){
        $this->model = $model;
    }
    public function showRegister($message=null) {
        echo "<!DOCTYPE html>
                <html lang=\"nl\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Register</title>
                    <link rel='stylesheet' href='css/bootstrap.min.css'>
                </head>
                        <body>
                        <div class='container'>
                        <h1>Registreer</h1>
                        <form method=\"post\" action=''>
                            <table>
                            <tr><td colspan='2'>$message</td></tr>
                            <tr>
                                <td><label for='username''>gebruikersnaam</label></td>
                                <td><input type=\"text\" name=\"username\" value='' /></td>
                             </tr>
                            <tr><td>
                                <label for=\"password\">wachtwoord</label></td><td>
                                <input type=\"text\" name=\"password\"/></td></tr>
                                <tr><td>
                                <label for=\"role\">rol</label></td><td>
                                <input type=\"text\" name=\"role\"/></td></tr>
                            <tr><td>
                                <input class='btn btn-success' type='submit' name='register' value='Registreren'>
                                </td></tr></table>
                                </div>
                        </form>
                        </body>
                        </html>
        ";

    }
    public function showLogin($message=null)
    {
        echo "<!DOCTYPE html>
                <html lang=\"nl\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Login</title>
                    <link rel='stylesheet' href='css/bootstrap.min.css'>
                </head>
                        <body>
                        <div class='container'>
                        <h1>Login</h1>
                        <form method=\"post\" action=''>
                            <table>
                            <tr><td colspan='2'>$message</td></tr>
                            <tr><td>
                                <label for='username''>Gebruikersnaam</label></td><td>
                                <input type=\"text\" name=\"username\" value='' /></td></tr>
                            <tr><td>
                                <label for=\"password\">Wachtwoord</label></td><td>
                                <input type=\"text\" name=\"password\"/></td></tr>
                            <tr><td>
                                <input class='btn btn-primary' type='submit' name='login' value='Inloggen'></td><td>
                                </td></tr></table>
                                <input class='btn btn-primary' type='submit' name='registerbutton' value='Registreren'>
                                </div>
                        </form>
                        </body>
                        </html>
        ";
    }
    public function showPatienten($result = null){
        if($result == 1){
            echo "<h4>Actie geslaagd</h4>";
        }
        $patienten = $this->model->getPatienten();

        /*de html template */
        echo "<!DOCTYPE html>
                <html lang=\"nl\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Overzicht patienten</title>
                    <link rel='stylesheet' href='css/bootstrap.min.css'>
                </head>
                <body>";
        echo "                    <form action='index.php' method='post'>
                             <input type='hidden' name='logout' value='0'>
                             <input type='submit' value='Uitloggen'/>
                                </form>
                                <div class='container-fluid'>
                                <h2>Patienten overzicht</h2> <form action='index.php' method='post'>
                               <input type='hidden' name='showFormpatient' value='0'>
                               <input class='btn btn-success' type='submit' value='Toevoegen'/>
                               </div>
                               </form></div></body></html>";
        if($patienten !== null) { echo "
                        <div id=\"patienten\">";
            foreach ($patienten as $patient) {
                echo "<div class='container-fluid border border-dark'>
                         <div class='row'>
                                       <div class='col-sm'>
                                       <a>Naam: </a> <br>
                                      $patient->naam
                                      </div>
                                      <div class='col-sm'>
                                      <a>adres: </a> <br>
                                      $patient->adres
                                      </div>
                                      <div class='col-sm'>
                                      <a>woonplaats: </a> <br>
                                      $patient->woonplaats
                                      </div>
                                      <div class='col-sm'>
                                      <a>zknummer: </a> <br>
                                      $patient->zknummer
                                      </div>
                                      <div class='col-sm'>
                                      <a>geboortedatum: </a> <br>
                                      $patient->geboortedatum
                                      </div>
                                      <div class='col-sm'> 
                                      <a>soortverzekering: </a> <br>
                                      $patient->soortverzekering
                                      </div>
                                      <div class='col-sm'>
                                      <form action='index.php' method='post'>
                                       <input type='hidden' name='showFormpatient' value='$patient->id'><input class='btn btn-primary' type='submit' value='Wijzigen'/></form>
                                        </div>
                                        <div class='col-sm'>
                                        <form action='index.php' method='post'>
                                       <input type='hidden' name='deletepatient' value='$patient->id'><input class='btn btn-danger' type='submit' value='Verwijderen'/></form>
                                         </div>
                                       </div>
                                    </div>
                                    <br>";
            }
        }
        else{
            echo "Geen patienten gevonden";
        }

    }
    public function showFormPatienten($id=null){
        if($id !=null && $id !=0){
            $patient = $this->model->selectPatient($id);
        }
        /*de html template */
        echo "<!DOCTYPE html>
        <html lang=\"nl\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Beheer patientengegevens</title>
            <link rel='stylesheet' href='css/bootstrap.min.css'>
        </head><body>
        <h2>Formulier patientgegevens</h2>";
        if(isset($patient)){
            echo "<form method='post' >
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value='$id'/></td></tr>
             <tr><td>   <label for=\"naam\">Patient naam</label></td><td>
                <input type=\"text\" name=\"naam\" value= '".$patient->naam."'/></td></tr>
            <tr><td>
                <label for=\"adres\">adres</label></td><td>
                <input type=\"text\" name=\"adres\" value = '".$patient->adres."'/></td></tr>
            <tr><td>
                <label for=\"woonplaats\">woonplaats</label></td><td>
                <input type=\"text\" name=\"woonplaats\" value= '".$patient->woonplaats."'/></td></tr>
            <tr><td>
                <label for=\"geboortedatum\">geboortedatum</label></td><td>
                <input type=\"text\" name=\"geboortedatum\" value= '".$patient->geboortedatum."'/></td></tr>
            <tr><td>
                <label for=\"zknummer\">zknummer</label></td><td>
                <input type=\"text\" name=\"zknummer\" value= '".$patient->zknummer."'/></td></tr>
                 <tr><td>
                <label for=\"soortverzekering\">soortverzekering</label></td><td>
                <input type=\"text\" name=\"soortverzekering\" value= '".$patient->soortverzekering."'/></td></tr>
            <tr><td>
                <input class='btn btn-primary' type='submit' name='updatepatient' value='opslaan'></td><td>
            </td></tr></table>
            </form>
        </body>
        </html>";
        }
        else{
            /*de html template */
            echo "
<form method='post' action='index.php'>
<div class='container-fluid border border-dark'>
                         <div class='row'>
                                       <div class='col-sm'>
                <input type=\"hidden\" name=\"id\" value=''/></div>
            <div class='col-sm'><label for=\"naam\">Patient naam:</label>
                <input type=\"text\" name=\"naam\" value= ''/></div>
            <div class='col-sm'>
                <label for=\"adres\">adres:</label>
                <input type=\"text\" name=\"adres\" value = ''/></div>
            <div class='col-sm'>
                <label for=\"woonplaats\">woonplaats:</label>
                <input type=\"text\" name=\"woonplaats\" value= ''/></div>
            <div class='col-sm'>
                <label for=\"geboortedatum\">geboortedatum:</label>
                <input type=\"text\" name=\"geboortedatum\" value= ''/></div>
            <div class='col-sm'>
                <label for=\"zknummer\">zknummer:</label>
                <input type=\"text\" name=\"zknummer\" value= ''/></div>
            <div class='col-sm'>
                <label for=\"soortverzekering\">soortverzekering:</label>
                <input type=\"text\" name=\"soortverzekering\" value= ''/></div>
           <div class='col-sm'>
                <input class='btn btn-success' type='submit' name='createpatient' value='opslaan'></div>
             </div>
            </div>
            </form>
        </body>
        </html>";
        }
    }
    public function showMedicijnen($result = null){
        if($result == 1){
            echo "<h4>Actie geslaagd</h4>";
        }
        $medicijnen = $this->model->getMedicijnen();

        /*de html template */
        echo "<!DOCTYPE html>
                <html lang=\"nl\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Overzicht medicijnen</title>
                    <link rel='stylesheet' href='css/bootstrap.min.css'>
                </head>
                <body>";

                   echo "       
                               <h2>Medicijnen overzicht</h2> <form action='index.php' method='post'>
                               <input type='hidden' name='showForm' value='0'>
                               <input class='btn btn-success' type='submit' value='toevoegen'/>
                               </form></div></body></html>";
                        if($medicijnen !== null) { echo "
                        <div id=\"medicijnen\">";
                            foreach ($medicijnen as $medicijn) {
                                echo "<div class=\"medicijnen\">
                                      <div class='container-fluid border border-dark'>
                                      <div class='row'>
                                      <div class='col-sm'>
                                      <p>Medicijn:</p> 
                                      $medicijn->type</div>
                                      <div class='col-sm'>
                                      <p>Omschrijving:</p>
                                      $medicijn->omschrijving</div>
                                      <div class='col-sm'>
                                      <p>Bijwerking:</p>
                                      $medicijn->bijwerking</div>
                                      <form action='index.php' method='post'>
                                      <div class='col-sm'>
                                       <input type='hidden' name='showForm' value='$medicijn->id'><input class='btn btn-primary' type='submit' value='wijzigen'/></form></div>
                                        <form action='index.php' method='post'>
                                        <div class='col-sm'>
                                       <input type='hidden' name='delete' value='$medicijn->id'><input class='btn btn-danger' type='submit' value='verwijderen'/></form>
                                       </div>
                                       </div>
                                       </div>
                                    </div>";
                            }
                        }
                    else{
                        echo "Geen patienten gevonden";
                    }

    }
    public function showFormMedicijnen($id=null){
        if($id !=null && $id !=0){
            $medicijn = $this->model->selectMedicijn($id);
        }
        /*de html template */
        echo "<!DOCTYPE html>
        <html lang=\"nl\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Beheer Medicijnengegevens</title>
        </head><body>
        <h2>Formulier Medicijngegevens</h2>";
    if(isset($medicijn)){
        echo "<form method='post' >
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value='$id'/></td></tr>
             <tr><td>   <label for=\"type\">Medicijn naam</label></td><td>
                <input type=\"text\" name=\"type\" value= '".$medicijn->type."'/></td></tr>
            <tr><td>
                <label for=\"adres\">omschrijving</label></td><td>
                <input type=\"text\" name=\"omschrijving\" value = '".$medicijn->omschrijving."'/></td></tr>
            <tr><td>
                <label for=\"woonplaats\">Bijwerking(en)</label></td><td>
                <input type=\"text\" name=\"bijwerking\" value= '".$medicijn->bijwerking."'/></td></tr>
            <tr><td>
            <tr><td>
                <input type='submit' name='update' value='opslaan'></td><td>
            </td></tr></table>
            </form>
        </body>
        </html>";
    }
    else{
        /*de html template */
        echo "<form method='post' action='index.php'>
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value=''/></td></tr>
             <tr><td>   <label for=\"type\">Medicijn naam</label></td><td>
                <input type=\"text\" name=\"type\" value= ''/></td></tr>
            <tr><td>
                <label for=\"omschrijving\">Omschrijving</label></td><td>
                <input type=\"text\" name=\"omschrijving\" value = ''/></td></tr>
            <tr><td>
                <label for=\"bijwerking\">Bijwerking(en)</label></td><td>
                <input type=\"text\" name=\"bijwerking\" value= ''/></td></tr>
            <tr><td>
            <tr><td>
                <input type='submit' name='create' value='opslaan'></td><td>
            </td></tr></table>
            </form>
        </body>
        </html>";
    }
    }
}