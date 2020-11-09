<html>
<body>
<form method="post" action="">
    <label>Getal1</label>
    <input type="text" name="getal1"><br>

    <input type="radio" name="keuze" value="+">Optellen
    <input type="radio" name="keuze" value="-">Aftrekken
    <input type="radio" name="keuze" value="*">Keer
    <input type="radio" name="keuze" value="/">Delen<br>

    <label>Getal2</label>
    <input type="text" name="getal2"><br>

    <input type="submit" name="send" value="Bereken">

</form>
</body>
</html>
<?php
if (isset($_POST['send'])) {
    $getal1 = $_POST['getal1'];
    $getal2 = $_POST['getal2'];
    $keuze = $_POST['keuze'];
    $totaal = 0;

    if ($keuze == "+") {
        $totaal = $getal1 + $getal2;
        echo $getal1 . "+" . $getal2 . "=" . $totaal;
    }
    if ($keuze == "-") {
        $totaal = $getal1 - $getal2;
        echo $getal1 . "-" . $getal2 . "=" . $totaal;
    }
    if ($keuze == "*") {
        $totaal = $getal1 * $getal2;
        echo $getal1 . "*" . $getal2 . "=" . $totaal;
    }
    if ($keuze == "/") {
        $totaal = $getal1 / $getal2;
        echo $getal1 . "/" . $getal2 . "=" . $totaal;
    }

} else {
    return "kies een optie";
}

?>