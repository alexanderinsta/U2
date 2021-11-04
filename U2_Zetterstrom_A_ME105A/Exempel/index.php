<?php
// Startsidan. Glöm inte inkludera footer/header/functions-filerna på de sidor
// som behöver dom. Glöm inte heller session_start när det behövs!
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
require_once "includes/header.php";


echo "welcome to dog imdb";
echo '<p>you can <a href="/sign-in.php">sign in</a> or <a href="/list.php">list all of the dogs</a></p>';




require_once "includes/footer.php";
