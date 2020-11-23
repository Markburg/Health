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
    public function homePage() {
            echo " <!DOCTYPE html>
    <html lang=\"nl\">
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
        <meta name=\"robots\" content=\"all\"/>
        <meta name=\"language\" content=\"Dutch\">
        <meta name=\"Author\" content=\"Mark Van Den Burg\">
        <meta name=\"description\" content=\"Zilveren kruis database\">
        <meta name=\"keywords\" content=\"doktoren,apotheken,medicijnen,recepten\">
        <title>HealthOne</title>
        <style>
            * {
        margin: 0;
        padding: 0;
        font-family: 'Roboto Slab', serif;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        background-color: mintcream;
        width: 100%;
        height: 100%;
    }
    header {
        background-color: #fff;
        width: 100%;
    }
    nav {
        z-index: 99;
        width: 100%;
        height: 50px;
        background-color: #3f3e40;
        font-size: 20px;
        text-transform: uppercase;
        position: sticky;
        top: 0;
        transition: top 0.3s;
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    nav ul {
        align-self: center;
        padding: 0;
        margin: 0;
        list-style: none;
    }
    nav li {
        float: left;
        margin: 0px 35px 0px 35px;
    }
    nav a {
        display: block;
        text-decoration: none;
        font-weight: bold;
        color: white;
    }
    nav ul li a:hover,
    nav ul li a:focus {
        color: #ffc304;
        text-decoration: none;
    }
</style>
    </head>
    <body>
        <nav id='nav'>
        <img src='images/Logo1.PNG'/>
                 <ul>
                 <li><a href=\"../index.php\"><img id='Home' src='images/Logo1.PNG' alt=''/></a></li>
                 <li><a href=\"/index.php\">Home</a></li>
         </ul>
</body>
    </html>
            ";
    }
    public function showLogin()
    {
        echo "<!DOCTYPE html>
                <html lang=\"nl\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Login</title>
                </head>
                        <body>
                        <form method=\"post\" action=\"index.php\">
                            <table>
                        
                            <tr><td>
                                <label for='username''>gebruikersnaam</label></td><td>
                                <input type=\"text\" name=\"username\" value='' /></td></tr>
                            <tr><td>
                                <label for=\"password\">wachtwoord</label></td><td>
                                <input type=\"text\" name=\"password\"/></td></tr>
                            <tr><td>
                                <input type='submit' name='login' value='Inloggen'></td><td>
                                </td></tr></table>
                        </form>
                        </body>
                        </html>
        ";
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
                    <style>
                        #medicijnen{
                            display:grid;
                            grid-template-columns:repeat(4,1fr);                
                            grid-column-gap:10px;
                            grid-row-gap:10px;
                            justify-content: center;
                        }
                        .medicijn{
                            width:80%;
                            background-color:#ccccff;
                            color:darkslategray;
                            font-size:24px;
                            padding:10px;
                            border-radius:10px;
                        }
                    </style>
                </head>
                <body>";

                   echo "       <form action='index.php' method='post'>
                             <input type='hidden' name='logout' value='0'>
                             <input type='submit' value='Uitloggen'/>
                                </form>
                               <h2>Overzicht medicijnen</h2> <form action='index.php' method='post'>
                               <input type='hidden' name='showForm' value='0'>
                               <input type='submit' value='toevoegen'/>
                               </form></div></body></html>";
                        if($medicijnen !== null) { echo "
                        <div id=\"medicijnen\">";
                            foreach ($medicijnen as $medicijn) {
                                echo "<div class=\"medicijn\">
                                      <p>Medicijn:</p> 
                                      $medicijn->type<br />
                                      <p>Omschrijving:</p>
                                      $medicijn->omschrijving<br />
                                      <p>Bijwerking:</p>
                                      $medicijn->bijwerking<br />
                                      <form action='index.php' method='post'>
                                       <input type='hidden' name='showForm' value='$medicijn->id'><input type='submit' value='wijzigen'/></form>
                                        <form action='index.php' method='post'>
                                       <input type='hidden' name='delete' value='$medicijn->id'><input type='submit' value='verwijderen'/></form>
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