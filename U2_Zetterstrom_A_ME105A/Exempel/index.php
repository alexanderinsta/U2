<?php

session_start();
require_once "includes/header.php";


echo "welcome to dog imdb";
echo '<p>you can <a href="/sign-in.php">sign in</a> or <a href="/list.php">list all of the dogs</a></p>';




require_once "includes/footer.php";
