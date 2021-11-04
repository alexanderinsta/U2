<?php
// Samling av relevanta funktioner, t.ex.:
// - Hämta en användare från databasen
// - Hämta alla hundar från databasen
// - Hämta en hund från databasen
// - Lägg till en ny hund i databasen
// ... med mera.






function grabOneDog($dogID)
{

    $allDogs = grabAllDogs();

    foreach ($allDogs as $dog) {
        if ($dog["id"] == $dogID) {
            return $dog;
        }
    }
    echo NULL;
}

function grabOneBreed($breed)
{
    $allDogs = grabAllDogs();

    $filteredAllDogs = [];

    foreach ($allDogs as $dog) {
        if (strtoupper($dog["breed"]) == strtoupper($breed)) {
            $filteredAllDogs[] = $dog;
        }
    }
    return $filteredAllDogs;
}

function grabAllUserDogs($userID)
{
    $allOwnerDogs = grabAllDogs();

    $filteredAllOwnerDogs = [];

    foreach ($allOwnerDogs as $dog) {
        if ($dog["owner"] == $userID) {
            $filteredAllOwnerDogs[] = $dog;
        }
    }
    return $filteredAllOwnerDogs;
}

function grabAllDogs()
{
    $json = file_get_contents("db.json");

    $data = json_decode($json, true);

    return $data["dogs"];
}

function grabOneUser($userID)
{

    $allUsers = grabAllUsers();

    foreach ($allUsers as $user) {
        if ($user["id"] == $userID) {
            return $user;
        }
    }
    echo NULL;
}

function grabAllUsers()
{
    $json = file_get_contents("db.json");

    $data = json_decode($json, true);

    return $data["users"];
}

function dogPrinter($dogsArrray, $userArray, $trueOrFalse)
{
    $html = '
    <div id="listOfDogs">
    <div id="dogname">Name</div>
    <div id="dogbreed">Breed</div>
    <div id="dogage">Age</div>
    <div id="dognotes">Notes</div>
    <div id="dogowner">Owner</div> 

    
    ';
    if ($trueOrFalse) {
        $html .= '<div id="delete">delete</div></div>';
    } else {
        $html .= "</div>";
    }

    $doc = new DOMDocument();
    $doc->loadHTML($html);


    foreach ($dogsArrray as $dog) {

        $name = $dog["name"];
        $breed = $dog["breed"];
        $age = $dog["age"];
        $notes = $dog["notes"];
        $owner = $dog["owner"];
        $id = $dog["id"];

        foreach ($userArray as $user) {
            if ($owner == $user["id"]) {
                $ownerName = $user["username"];
            }
        }

        //get the element you want to append to
        $grabDogName = $doc->getElementById('dogname');
        $gragDogBreed = $doc->getElementById('dogbreed');
        $grabDogAge = $doc->getElementById('dogage');
        $grabDogNotes = $doc->getElementById('dognotes');
        $grabDogOwner  = $doc->getElementById('dogowner');


        //create the element to append to #element1
        $dogNameLink = $doc->createElement("a", "$name");
        $dogBreedLink = $doc->createElement("a", "$breed");
        $dogAge = $doc->createElement("div", "$age");
        $dogNotes = $doc->createElement("div", "$notes");
        $dogOwner = $doc->createElement("div", "$ownerName");




        $dogNameLink->setAttribute('href', "show.php?id=$id");
        $dogBreedLink->setAttribute('href', "list.php?breed=$breed");
        $dogAge->setAttribute('style', "$age");
        $dogNotes->setAttribute('style', "$notes");
        $dogOwner->setAttribute('style', "$owner");


        if ($trueOrFalse) {
            $grabDeleteButton = $doc->getElementById('delete');

            $deleteButton = $doc->createElement("a", "delete");

            $deleteButton->setAttribute('href', "delete.php?id=$id");


            $grabDeleteButton->appendChild($deleteButton);
        }


        //actually append the element
        $grabDogName->appendChild($dogNameLink);
        $gragDogBreed->appendChild($dogBreedLink);
        $grabDogAge->appendChild($dogAge);
        $grabDogNotes->appendChild($dogNotes);
        $grabDogOwner->appendChild($dogOwner);
    }


    echo $doc->saveHTML();
}
