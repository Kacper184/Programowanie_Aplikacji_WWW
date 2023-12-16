<!DOCTYPE html>

<?php

// ===================================================
// Główny plik generujący konkretną podstronę na podstawie
// Podanego idp
// Jest to główny szkielet strony
// ===================================================

// Wyświetlanie wszystkich błędów
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

?>

<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="content-Language" content="pl" />
    <meta name="Author" content="Kacper Wach" />
    <title>PowerNotes</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/kolorujtlo.js" type="text/JavaScript"></script>
    <script src="js/timedate.js" type="text/JavaScript"></script>
    <script src="js/jquery-3.7.1.js"></script>
</head>

<body onload="startclock()">
    <header>
        <div class="logo">
            <a>Power<a class="red-logo">Notes</a></a>
        </div>
        <ul class="navbar-ul">
            <li class="nv-li"><a class="nv-links" href="index.php?idp=glowna">Menu</a></li>
            <li class="nv-li"><a class="nv-links" href="index.php?idp=contact">Kontakt</a></li>
            <li class="nv-li"><a class="nv-links" href="index.php?idp=howitworks">Jak to działa ?</a></li>
            <li class="nv-li"><a class="nv-links" href="index.php?idp=idea">Idea</a></li>
            <li class="nv-li"><a class="nv-links" href="index.php?idp=about">O mnie</a></li>
            <li class="nv-li"><a class="nv-links" href="index.php?idp=dojavy">JavaScript</a></li>
            <li class="nv-li"><a class="nv-links" href="index.php?idp=filmy">Filmy</a></li>
        </ul>
    </header>

    <?php
    // Funkcja sprawdzająca czy istnieje konkretne kliknięte 'IDP' i przenosi nas na tą strone lub wyświetla błąd
    function includeOption($strona)
    {
        if (file_exists($strona)) {
            include($strona);
        } else {
            echo "Strona nie istnieje.";
        }
    }
    // Zmienna idp służy do określenia na jaką storne chce dostać się użytkownik
    if (isset($_GET['idp'])) {
        $idp = $_GET['idp'];

        if ($idp == 'glowna') {
            $strona = 'html/glowna.html';
        } elseif ($idp == 'contact') {
            $strona = 'html/contact.html';
        } elseif ($idp == 'howitworks') {
            $strona = 'html/howitworks.html';
        } elseif ($idp == 'idea') {
            $strona = 'html/idea.html';
        } elseif ($idp == 'about') {
            $strona = 'html/about.html';
        } elseif ($idp == 'dojavy') {
            $strona = 'html/dojavy.html';
        } elseif ($idp == 'filmy') {
            $strona = 'html/filmy.html';
        }

        includeOption($strona);
    }
    ?>

    <?php
    $nr_indeksu = '164438';
    $nr_grupy = '4';
    echo 'Autor: Kacper Wach ' . $nr_indeksu . ' grupa ' . $nr_grupy . '<br><br>';
    ?>
    <footer>
        <div class="foot">
            <b>Stworzył: Kacper <span class="color">Wach&nbsp;&nbsp;</span></b>
            <i>Grupa 4, nr indeksu: 164438</i>
            <div id="zegarek" class="clock_one"></div><br>
            <div id="data" class="clock_one"></div>
        </div>
    </footer>
</body>

</html>