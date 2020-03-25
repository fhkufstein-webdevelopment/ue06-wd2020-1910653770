<?php

//@TODO insert your code here
require_once('includes/classes/Database.php');

//Definition von Konstanten für Database.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'ue06-wd2020-1910653770');
define('DB_USER', 'admin02');
define('DB_PASS', 'password');

//Datenbank Objekt erzeugen
$db = new Database();

//neuen Nutzer anlegen
$cryptedPassword = password_hash('testpassword',PASSWORD_BCRYPT);
$username = "test";

//SQL Statement
$cryptedPassword = $db->escapeString($cryptedPassword);
$username = $db->escapeString($username);

//Zusammenfügen von Strings: "Hallo"."Welt"
//Escape für Schlüsselwörter: `xxx`


//Abfrage erstellen
//$sql = "INSERT INTO user(name, `password`) VALUES('".$username ."','".$cryptedPassword."')";

//Abfrage ausführen
//$db->query($sql);

//Beim 2. Durchlauf
//Fatal Error! MySQL-Error (1062): Duplicate entry 'test' for key 'name'


//Ist User vorhanden?
$sql = "SELECT * FROM user WHERE name = '".$username."'";
$result = $db->query($sql);

if($db->numRows($result) > 0){ //ist die Anzahl der Zeilen größer als 0

    $row = $db->fetchAssoc($result); //fetchAssoc - "Methode", um auf die Spalten zuzugreifen

    if(password_verify("testpassword", $row['password'])){
        echo "Der Nutzer ".$username." mit der ID ".$row['id']." hat ";
        echo "das Passwort testpassword";
    }
    else {
        echo "Nutzer gefunden, aber falsches Passwort!";
    }
}
else {
    echo "Kein Nutzer gefunden.";
}
