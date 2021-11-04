<?php
session_start();

require_once "includes/header.php";
require_once "includes/functions.php";

//Kollar om personen skickades hit med ett ID. om hen gjorde det så sparar den IDt i en variabel och hämtar alla hundar. Sen går vi igenom alla hundar och om den hittar en match av id mellan ID som blev medskickata och IDt i arrayen i dbn så kommer blir får flag check true. om den blir true så kommer vi hämta en hund och användare med hund IDt medskickat och ägaren som vi får när vi hämtar hunden.

if ((isset($_GET["id"]))) {
    $dogID = $_GET["id"];
    $allDogs = grabAllDogs();

    $found = false;
    foreach ($allDogs as $dog) {
        if ($dog["id"] == $dogID) {
            $found = true;
        }
    }



    if (!$found) {
        echo "dog doesnt exist";
    } else {
        $dogObject = grabOneDog($dogID);
        $ownerObject = grabOneUser($dogObject["owner"]);


        echo "
            <h1>" . $dogObject["name"] . "</h1>
            <p>A" . $dogObject["breed"] . " thats " . $dogObject["age"] . " years old, owned by " . $ownerObject["username"] . " \" " . $dogObject["notes"] . "\"</p>
            
            ";
    }
}



require_once "includes/footer.php";
