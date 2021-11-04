<?php

session_start();


//unsetta alla variabler
session_unset();

//töm vår session
session_destroy();

//Skickar användaren till index efter session är tömd
header("Location:index.php");
exit();
