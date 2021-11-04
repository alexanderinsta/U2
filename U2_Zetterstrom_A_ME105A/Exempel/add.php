<?php
// Sidan för att lägga till en ny hund, tänk på att man måste vara inloggad för
// att se och kunna besöka denna.

error_reporting(-1);

session_start();


//Kollar ifall användaren är inloggad(true), om inte så skickas hen till sign in
if (!isset($_SESSION["isLoggedIn"])) {
    header("Location: sign-in.php");
}
require_once "includes/header.php";
//Sparar användaren som är inloggads ID som userid som används till hundens ägare
$userid =  $_SESSION["id"];

$json = file_get_contents("db.json");
$data = json_decode($json, true);

//Kollar så personen har skickat med informationen via formuläret och att det inte hade tomma rader
if (isset($_POST["dogname"], $_POST["dogbreed"], $_POST["dogage"], $_POST["dognote"])) {

    if (empty($_POST["dogname"]) || empty($_POST["dogbreed"]) ||   empty($_POST["dogage"]) || empty($_POST["dognote"])) {
        echo  "please enter all information";
    } else {
        $dognameinput = $_POST["dogname"];
        $dogbreedinput = $_POST["dogbreed"];
        $dogdogageinput = $_POST["dogage"];
        $dognoteinput = $_POST["dognote"];

        //  $dogid = max(array_column($data["dogs"], 'id'));

        $arrayOfDogIDs = array_column($data["dogs"], 'id');
        array_push($arrayOfDogIDs, 0);

        $dogid = max($arrayOfDogIDs);


        $doginputobject = $data["dogs"][] =  [
            'name' => "$dognameinput",
            'breed' => "$dogbreedinput",
            'age' => $dogdogageinput,
            'notes' => "$dognoteinput",
            'owner' => $userid,
            'id' => $dogid + 1
        ];
        echo "dog added";
    }
} else {
    echo "please enter the form";
}



$json = json_encode($data, JSON_PRETTY_PRINT);

file_put_contents("db.json", $json);



echo $html = '
<div>
<form action="add.php" method="post">
dog name: <input type="text" name="dogname">
breed: <input type="text" name="dogbreed">
age: <input type="number" name="dogage">
note: <input type="text" name="dognote">
<input type="submit">
</form></div>
';


require_once "includes/footer.php";
