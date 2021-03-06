<?php
namespace view;
use model\Patient;

include_once ('model/Model.php');
include_once ('model/User.php');
include_once('model/Medicijn.php');

class View
{

    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function showRegister($message = null)
    {
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
                                <select name='role'>    
                                <option value='patiënt'>Patiënt</option>                           
                                <option value='apotheker'>Apotheker</option>                                
                                <option value='dokter'>Dokter</option>                                
                                </select></td></tr>
                            <tr><td>
                                <input class='btn btn-success' type='submit' name='register' value='Registreren'>
                                </td></tr></table>
                                </div>
                        </form>
                        </body>
                        </html>
        ";

    }

    public function showLogin($message = null)
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

    public function showPatienten($result = null)
    {
        if ($result == 1) {
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
                             <input class='btn btn-danger' type='submit' value='Uitloggen'/>
                                </form>
                                <div class='container-fluid'>
                                <h2>Patienten overzicht</h2> <form action='index.php' method='post'>
                               <input type='hidden' name='showFormpatient' value='0'>
                               <input class='btn btn-success' type='submit' value='Toevoegen'/>
                               </div>
                               </form></div></body></html>";
        if ($patienten !== null) {
            echo "
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
        } else {
            echo "Geen patienten gevonden";
        }

    }

    public function showFormPatienten($id = null)
    {
        if ($id != null && $id != 0) {
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
        if (isset($patient)) {
            echo "<form method='post' >
        <div class='container-fluid border border-dark'>
             <div class='row'>
                <input type=\"hidden\" name=\"id\" value='$id'/>
                <div class='col-sm'><label for=\"naam\">Patient naam</label>
                <input type=\"text\" name=\"naam\" value= '" . $patient->naam . "'/></div>
            <div class='col-sm'>
                <label for=\"adres\">adres</label>
                <input type=\"text\" name=\"adres\" value = '" . $patient->adres . "'/></div>
            <div class='col-sm'>
                <label for=\"woonplaats\">woonplaats</label>
                <input type=\"text\" name=\"woonplaats\" value= '" . $patient->woonplaats . "'/></div>
            <div class='col-sm'>
                <label for=\"geboortedatum\">geboortedatum</label>
                <input type=\"text\" name=\"geboortedatum\" value= '" . $patient->geboortedatum . "'/></div>
            <div class='col-sm'>
                <label for=\"zknummer\">zknummer</label>
                <input type=\"text\" name=\"zknummer\" value= '" . $patient->zknummer . "'/></div>
            <div class='col-sm'>
                <label for=\"soortverzekering\">soortverzekering</label>
                <input type=\"text\" name=\"soortverzekering\" value= '" . $patient->soortverzekering . "'/></div>
            <div class='col-sm'>
                <input class='btn btn-primary' type='submit' name='updatepatient' value='opslaan'></div>
            </div>
            </div>
            </form>
        </body>
        </html>";
        } else {
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

    public function showMedicijnen($result = null)
    {
        if ($result == 1) {
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

        echo "    <form action='index.php' method='post'>
                             <input type='hidden' name='logout' value='0'>
                             <input class='btn btn-danger' type='submit' value='Uitloggen'/>
                                </form>
                <h2>Medicijnen overzicht</h2> <form action='index.php' method='post'>
                               <input type='hidden' name='showForm' value='0'>
                               <input class='btn btn-success' type='submit' value='toevoegen'/>
                               </form></div></body></html>";
        if ($medicijnen !== null) {
            echo "
                        <div id=\"medicijnen\">";
            foreach ($medicijnen as $medicijn) {
                echo "<div class='container-fluid border border-dark'>
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
        } else {
            echo "Geen medicijnen gevonden";
        }

    }

    public function showFormMedicijnen($id = null)
    {
        if ($id != null && $id != 0) {
            $medicijn = $this->model->selectMedicijn($id);
        }
        /*de html template */
        echo "<!DOCTYPE html>
        <html lang=\"nl\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Beheer Medicijnengegevens</title>
            <link rel='stylesheet' href='css/bootstrap.min.css'>
        </head><body>
        <h2>Formulier Medicijngegevens</h2>";
        if (isset($medicijn)) {
            echo "<form method='post' >
            <div class='container-fluid border border-dark'>
                  <div class='row'>
                <input type=\"hidden\" name=\"id\" value='$id'/>
                <div class='col-sm'>
                <label for=\"type\">Medicijn naam</label>
                <input type=\"text\" name=\"type\" value= '" . $medicijn->type . "'/></div>
            <div class='col-sm'>
                <label for=\"adres\">omschrijving</label>
                <input type=\"text\" name=\"omschrijving\" value = '" . $medicijn->omschrijving . "'/></div>
            <div class='col-sm'>
                <label for=\"woonplaats\">Bijwerking(en)</label>
                <input type=\"text\" name=\"bijwerking\" value= '" . $medicijn->bijwerking . "'/></div>
            <div class='col-sm'>
                <input class='btn btn-primary' type='submit' name='update' value='opslaan'></div>
                </div>
            </div>
            </form>
        </body>
        </html>";
        } else {
            /*de html template */
            echo "<form method='post' action='index.php'>
        <div class='container-fluid border border-dark'>
                  <div class='row'>
                <input type=\"hidden\" name=\"id\" value=''/>
             <div class='col-sm'>
             <label for=\"type\">Medicijn naam</label>
                <input type=\"text\" name=\"type\" value= ''/></div>
            <div class='col-sm'>
                <label for=\"omschrijving\">Omschrijving</label>
                <input type=\"text\" name=\"omschrijving\" value = ''/></div>
            <div class='col-sm'>
                <label for=\"bijwerking\">Bijwerking(en)</label>
                <input type=\"text\" name=\"bijwerking\" value= ''/></div>
            <div class='col-sm'>
                <input class='btn btn-primary' type='submit' name='create' value='opslaan'></div>
            </div>
            </div>
            </form>
        </body>
        </html>";
        }
    }

    public function showUsers($result = null)
    {
        if ($result == 1) {
            echo "<h4>Actie geslaagd</h4>";
        }
        $users = $this->model->getGebruiker();

        /*de html template */
        echo "<!DOCTYPE html>
                <html lang=\"nl\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Overzicht gebruikers</title>
                    <link rel='stylesheet' href='css/bootstrap.min.css'>
                </head>
                <body>";

        echo "    <form action='index.php' method='post'>
                             <input type='hidden' name='logout' value='0'>
                             <input class='btn btn-danger' type='submit' value='Uitloggen'/>
                                </form>
                    <h2>Gebruikers overzicht</h2> <form action='index.php' method='post'>
                               <input type='hidden' name='showFormusers' value='0'>
                               <input class='btn btn-success' type='submit' value='Toevoegen'/>
                               </form></div></body></html>";
        if ($users !== null) {
            echo "
                        <div id=\"users\">";
            foreach ($users as $user) {
                echo "<div class='container-fluid border border-dark'>
                                      <div class='row'>
                                      <div class='col-sm'>
                                      <p>Gebruikersnaam:</p> 
                                      $user->username</div>
                                      <div class='col-sm'>
                                      <p>Wachtwoord:</p>
                                      $user->password</div>
                                      <div class='col-sm'>
                                      <p>Rol:</p>
                                      $user->role</div>
                                      <form action='index.php' method='post'>
                                      <div class='col-sm'>
                                       <input type='hidden' name='showFormusers' value='$user->id'><input class='btn btn-primary' type='submit' value='wijzigen'/></form></div>
                                        <form action='index.php' method='post'>
                                        <div class='col-sm'>
                                       <input type='hidden' name='deleteUsers' value='$user->id'><input class='btn btn-danger' type='submit' value='verwijderen'/></form>
                                       </div>
                                       </div>
                                       </div>
                                    </div>";
            }
        } else {
            echo "Geen gebuikers gevonden";
        }

    }

    public function showFormUsers($id = null)
    {
        if ($id != null && $id != 0) {
            $user = $this->model->selectGebruiker($id);
        }
        /*de html template */
        echo "<!DOCTYPE html>
        <html lang=\"nl\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Beheer Gebruikersgegevens</title>
            <link rel='stylesheet' href='css/bootstrap.min.css'>
        </head><body>
        <h2>Formulier Gebruikersgegevens</h2>";
        if (isset($user)) {
            echo "<form method='post' >
            <div class='container-fluid border border-dark'>
                  <div class='row'>
                <input type=\"hidden\" name=\"id\" value='$id'/>
                <div class='col-sm'>
                <label for=\"username\">Gebruikersnaam</label>
                <input type=\"text\" name=\"username\" value= '" . $user->username . "'/></div>
            <div class='col-sm'>
                <label for=\"password\">Wachtwoord</label>
                <input type=\"text\" name=\"password\" value = '" . $user->password . "'/></div>
            <div class='col-sm'>
                <label for=\"role\">Rol</label>
                <input type=\"text\" name=\"role\" value= '" . $user->role . "'/></div>
            <div class='col-sm'>
                <input class='btn btn-primary' type='submit' name='updateUser' value='opslaan'></div>
                </div>
            </div>
            </form>
        </body>
        </html>";
        } else {
            /*de html template */
            echo "<form method='post' action='index.php'>
        <div class='container-fluid border border-dark'>
                  <div class='row'>
                <input type=\"hidden\" name=\"id\" value=''/>
             <div class='col-sm'>
             <label for=\"username\">Gebruikersnaam</label>
                <input type=\"text\" name=\"username\" value= ''/></div>
            <div class='col-sm'>
                <label for=\"password\">Wachtwoord</label>
                <input type=\"text\" name=\"password\" value = ''/></div>
            <div class='col-sm'>
                <label for=\"role\">Rol</label>
                <input type=\"text\" name=\"role\" value= ''/></div>
            <div class='col-sm'>
                <input class='btn btn-primary' type='submit' name='createUser' value='opslaan'></div>
            </div>
            </div>
            </form>
        </body>
        </html>";
        }
    }

    public function showDokters()
    {

        $dokters = $this->model->getDokters();

        /*de html template */
        echo "<!DOCTYPE html>
                <html lang=\"nl\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Overzicht dokters en apothekers</title>
                    <link rel='stylesheet' href='css/bootstrap.min.css'>
                </head>
                <body>";

        echo "    <h2>Dokters overzicht</h2> <form action='index.php' method='post'>
                               <input type='hidden' name='showFormdokters' value='0'>
                               <input type='hidden' name='logout' value='0'>
                               <input class='btn btn-danger' type='submit' value='Uitloggen'/>
                               </form></div></body></html>";
        foreach ($dokters as $dokter) {
            echo "<div class='container-fluid border border-dark'>
                                      <div class='row'>
                                      <div class='col-sm'>
                                      <p>naam:</p> 
                                      $dokter->username</div>                                     
                                      <div class='col-sm'>
                                      <p>Rol:</p>
                                      $dokter->role</div>                                     
                                       </div>
                                       </div>
                                    </div>";
        }
    }
    public function showApothekers()
    {

        $apothekers = $this->model->getApothekers();

        /*de html template */
        echo "<!DOCTYPE html>
                <html lang=\"nl\">
                <head>
                    <meta charset=\"UTF-8\">
                    <link rel='stylesheet' href='css/bootstrap.min.css'>
                </head>
                <body>";

        echo "  <form action='index.php' method='post'>
                             <input type='hidden' name='logout' value='0'>
                             <input class='btn btn-danger' type='submit' value='Uitloggen'/>
                                </form>  
                <h2>Apothekers overzicht</h2> <form action='index.php' method='post'>
                               <input type='hidden' name='showFormapothekers' value='0'>
                               </form></div></body></html>";
        foreach ($apothekers as $apotheker) {
            echo "<div class='container-fluid border border-dark'>
                                      <div class='row'>
                                      <div class='col-sm'>
                                      <p>naam:</p> 
                                      $apotheker->username</div>                                     
                                      <div class='col-sm'>
                                      <p>Rol:</p>
                                      $apotheker->role</div>                                     
                                       </div>
                                       </div>
                                    </div>";
        }
    }
}
