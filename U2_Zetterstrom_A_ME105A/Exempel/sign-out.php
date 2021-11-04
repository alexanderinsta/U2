<?php
// Utloggning. Töm sessionen på data innan du slussar vidare dom till start-
// eller inloggningssidan.
?>


<?php

session_start();


//unsetta alla variabler
session_unset();

//töm vår session
session_destroy();


header("Location:index.php");
exit();

?>


