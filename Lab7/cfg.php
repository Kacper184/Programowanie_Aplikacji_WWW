<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $baza = 'moja_strona';
    $login = 'admin';
    $pass = 'admin';

    $link = mysqli_connect($dbhost, $dbuser, $dbpass);
    if ($link->connect_error) {
        die('Przerwane połączenie: ' . $link->connect_error);
    }
    if (!$link->select_db($baza)) {
        die('Nie można wybrać bazy danych: ' . $link->error);
    }
?>