<?php
session_start();


if(isset($_SESSION['bekeken']))
    $_SESSION['bekeken'] +=1 ;
else
    $_SESSION['bekeken']=1;


setcookie("totaal", $_SESSION['bekeken'], time() + 3600);
echo $_COOKIE['totaal']. "<br>";

echo"Bekeken = ".$_SESSION['bekeken'];

