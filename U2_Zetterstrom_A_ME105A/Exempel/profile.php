<?php
// Profilsidan (obs. måste vara inloggad), lista en användares alla hundar.

session_start();


//Om användaren är inloggad (returnerar true) så kommer sidan skriva ut alla hundar, med användarens hundar, använadaren själv som inparametrar samt en boolean som kommer lägga till delete knappar ifall boolean är true. 
$loggedInUser = $_SESSION["id"];


if (isset($loggedInUser)) {
    require_once "includes/header.php";
    require_once "includes/functions.php";
    dogPrinter(grabAllUserDogs($loggedInUser), grabAllUsers($loggedInUser), true);
} else {
    //om användaren inte är inloggad skickas hen till index 
    header("Location: index.php");
}




require_once "includes/footer.php";
