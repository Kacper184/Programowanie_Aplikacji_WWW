<?php
    // Plik konfiguracyjny do połączenia się z bazą danych
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $baza = 'moja_strona';
    $login = 'admin';
    $pass = 'admin';

    // Połączenie i zalogowanie do bazy danych
    $link = mysqli_connect($dbhost, $dbuser, $dbpass);
    // Sprawdzanie czy Połącznie się powiodło
    if ($link->connect_error) {
        die('Przerwane połączenie: ' . $link->connect_error);
    }
    if (!$link->select_db($baza)) {
        die('Nie można wybrać bazy danych: ' . $link->error);
    }
?>