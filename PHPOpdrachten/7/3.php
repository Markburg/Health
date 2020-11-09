<html>

<head>
    <title>Dynamic Background Color Change</title>
</head>

<body bgcolor="<?php
if (isset($_POST['btn']))
{
    $color=$_POST['color'];
    if(isset($color))
    {
        echo $p=$color;
    }
    else
    {
        echo $p="pink";
    }
}
?>">

<form action="" method="post" >
    <input type="radio" name="color" value="pink"> Roze </input>
    <input type="radio" name="color" value="red"> Rood </input>
    <input type="radio" name="color" value="green"> Groen </input>
    <input type="radio" name="color" value="blue"> Blauw </input>
    <br>
    <input type="submit" name="btn" value="Submit">
</form>

</body>
</html>