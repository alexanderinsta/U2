<?php
// Start på er HTML (doctype, body, navigation)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Document</title>
</head>

<body>
    <main>
        <?php
        echo "<div id=\"logo\"><div id=\"logotext\">the internet dog database</div></div>"
        ?>
        <?php
        //Om personen är inloggad så kommer nav visa alla länkar annars bara de tre väsentliga

        if (isset($_SESSION["isLoggedIn"])) {
            echo '<nav>
            <a href="/index.php" >Home</a>
            <a href="/list.php" >Dogs</a>
            <a href="/add.php" >Add</a>
            <a href="/profile.php" >Profile</a>
            <a href="/sign-out.php" >Sign out</a>
</nav>';
        } else {
            echo '<nav>
    <a href="/index.php" >Home</a>
    <a href="/list.php" >Dogs</a>
    <a href="/sign-in.php" >Sign in</a>
    </nav>';
        }
        ?>