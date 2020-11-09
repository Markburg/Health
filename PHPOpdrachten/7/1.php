<html>
<body>
<form method="post" action="">
    <label>Bedrag exclusief btw</label>
    <input type="text" name="bedrag"><br>
    <label>btw</label><br>
    <input type="radio" name="btw" value="0.06">Laag.6%<br>
    <input type="radio" name="btw" value="0.21">Hoog.21%<br>

    <input type="submit" name="verzenden" value="Verzenden">

</form>
</body>
</html>
<?php
if (isset($_POST['verzenden'])) {
    $btw = $_POST['btw'];
    $bedrag = $_POST['bedrag'];
    $totaal = 0;
    $newbedrag = 0;

    echo "Bedrag zonder btw: " . $bedrag . "<br>";
    echo "btw gekozen: " . "6%" . "<br>";
    if ($btw == 0.06) {
        $newbedrag = $bedrag * $btw;
        $totaal = $bedrag - $newbedrag ;
    }
    elseif ($btw == 0.21){
        $newbedrag = $bedrag * $btw;
        $totaal = $bedrag - $newbedrag ;
    }
    echo "bedrag inclusief btw: ". $totaal;

} else {
    $btw = "";
    $bedrag = "";
}

?>