<?php
// Inloggningssidan. Tänk på att formuläret kan skicka uppgifterna till denna
// filen också. Det gäller då att du t.ex. kontrollerar om $_POST innehåller
// något. Om inloggningen lyckas slussar du vidare dom till listningssidan.



session_start();
$json = file_get_contents("db.json");
$data = json_decode($json, true);
//Om användaren har skickats hit med ett error så ska det komma ett errormeddelande
if (isset($_GET["error"])) {
    if ($_GET["error"] == 1) {
        echo "enter the required fields";
    } elseif ($_GET["error"] == 2) {
        echo "wrong information";
    }
} else {
    //Om användaren har skickat med ett email och lösenord så sparar detta i variabebler, sen går vi igenom alla användare och om variablerna stämmer med någon av användarna i user arrayen i db så kommer session få den användaren sparad och skickas senare vidare till profilesidan. skulle den däremot inte hitta en användare så kommer användaren få ett meddelande att informationen är fel. 
    if (isset($_POST["email"], $_POST["password"])) {

        $inputEmail = $_POST["email"];
        $inputPassword = $_POST["password"];

        foreach ($data["users"] as $user) {



            $userEmail = $user["email"];
            $userPassword = $user["password"];


            if ($userEmail == $inputEmail && $userPassword == $inputPassword) {
                $_SESSION["isLoggedIn"] = true;
                $_SESSION["username"] = $user["username"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["id"] = $user["id"];
                header("Location: list.php");
                exit();
            }
        }
        //Om någon av fälten är tomma eller om informationen inte stämmer så kommer den skicka en error kod som snappas upp av error hanteraren högst upp som ber användaren att fylla i alla fält. 
        if ($inputEmail == "" || $inputPassword == "") {
            header("Location: ../sign-in.php?error=1");
        } elseif ($userEmail != $inputEmail || $userPassword != $inputPassword) {
            header("Location: ../sign-in.php?error=2");
        }
    }
}

require_once "includes/header.php";

echo $html = '
<div>
<form action="sign-in.php" method="post">
E-mail: <input type="text" name="email">
Password: <input type="password" name="password">
<input type="submit">
</form></div>
';


require_once "includes/footer.php";
