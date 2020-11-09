<?php

session_start();

if(isset($_SESSION['bekeken']))
    $_SESSION['bekeken'] +=1 ;
else
    $_SESSION['bekeken']=1;

echo"Bekeken = ".$_SESSION['bekeken'];


