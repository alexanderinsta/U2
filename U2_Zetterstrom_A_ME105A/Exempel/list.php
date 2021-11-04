<?php
// Lista alla hundar.

session_start();
require_once "includes/header.php";
require_once "includes/functions.php";


//Om användaren har blivit hitskickad med ett breed så kommer vi skriva ut hundar baserad på breed annars så kommer alla hundar av olika breed visas upp.

if (isset($_GET["breed"])) {
    $dogBreed = $_GET["breed"];

    dogPrinter(grabOneBreed($dogBreed), grabAllUsers(), false);
} else {
    dogPrinter(grabAllDogs(), grabAllUsers(), false);
}





require_once "includes/footer.php";
