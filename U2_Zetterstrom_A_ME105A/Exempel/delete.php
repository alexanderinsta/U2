<?php
// Hanterar radering av en hund (obs. måste vara inloggad) och slussar sedan
// vidare användaren till profilsidan.
?>

<?php
session_start();
require_once "includes/functions.php";



//Kollar om användaren är inloggad, om inte så skickas hen till sign in.

//kollar om användaren blev hitskickad med ett hundid

if (isset($_SESSION["id"])) {
    if (isset($_GET["id"])) {
        $dogID = $_GET["id"];

        $json = file_get_contents("db.json");

        $data = json_decode($json, true);

        //går igenom alla hundar i dog delen av databasen och tar bort objektets position som vi får av $key i foreach efter vi gör en jämförelse av hundIDt vi skickade med och IDn som finns i hund arrayen i DB.
        foreach ($data["dogs"] as $key => $dog) {
            if ($dog["id"] == $dogID) {
                unset($data["dogs"][$key]);
            }
        }
        $json = json_encode($data, JSON_PRETTY_PRINT);

        file_put_contents("db.json", $json);

        header("Location: profile.php");
    }
} else {
    header("Location: sign-in.php");
}




?>