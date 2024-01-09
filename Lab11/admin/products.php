<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_products.css">
</head>

<body>

    <?php

    // ===================================================
    // Strona Pozwalająca edytowac/usuwac/dodawać Produkty
    // Posługujemy się bazą danych moja_strona tabela products
    // ===================================================
    
    include '../cfg.php';

    // Funkcja tworząca formualrz do dodawania Kategorii
    function DodajProdukt()
    {
        echo "<form method='post' action='products.php'>";
        echo "<h1>Dodaj Nowy Produkt</h1>";
        echo "<br><label>Nazwa Produktu: </label><br>";
        echo "<input type='text' name='nazwa' required><br>";
        echo "<br><label>opis: </label><br>";
        echo "<input type='text' name='opis' required><br><br>";
        echo "<br><label>cena_netto: </label><br>";
        echo "<input type='text' name='netto' required><br><br>";
        echo "<br><label>podatek vat: </label><br>";
        echo "<input type='text' name='vat' required><br><br>";
        echo "<br><label>ilosc sztuk: </label><br>";
        echo "<input type='text' name='sztuki' required><br><br>";
        echo "<br><label>status dostepnosci: </label><br>";
        echo "<input type='text' name='status' required><br><br>";
        echo "<br><label>kategoria produktu: </label><br>";
        echo "<input type='text' name='katprod' required><br><br>";
        echo "<br><label>gabaryt produktu: </label><br>";
        echo "<input type='text' name='gabaryt' required><br><br>";
        echo "<br><label>zdjęcie produktu: </label><br>";
        echo "<input type='file' name='zdjecie'><br><br>";
        echo "<input type='submit' name='Add_kat' value='Wyslij'><br><br>";
        echo "</form>";
    }

    // Funkcja tworząca formualrz do Usuwania Kategorii
    function UsunProdukt()
    {
        echo "<form method='post' action='products.php'>";
        echo "<h1>Usuń Produkt</h1>";
        echo "<br><label>Nazwa: </label><br>";
        echo "<input type='text' name='nazwa' required><br>";
        echo "<input type='submit' name='del_kat' value='Wyslij'><br><br>";
        echo "</form>";
    }

    // Funkcja tworząca formualrz do Edytowania Kategorii
    function EdytujProdukt()
    {
        echo "<form method='post' action='products.php'>";
        echo "<br><label>Nazwa Produktu: </label><br>";
        echo "<input type='text' name='nazwa' required><br>";
        echo "<br><label>opis: </label><br>";
        echo "<input type='text' name='opis' required><br><br>";
        echo "<br><label>cena_netto: </label><br>";
        echo "<input type='text' name='netto' required><br><br>";
        echo "<br><label>podatek vat: </label><br>";
        echo "<input type='text' name='vat' required><br><br>";
        echo "<br><label>ilosc sztuk: </label><br>";
        echo "<input type='text' name='sztuki' required><br><br>";
        echo "<br><label>status dostepnosci: </label><br>";
        echo "<input type='text' name='status' required><br><br>";
        echo "<br><label>kategoria produktu: </label><br>";
        echo "<input type='text' name='katprod' required><br><br>";
        echo "<br><label>gabaryt produktu: </label><br>";
        echo "<input type='text' name='gabaryt' required><br><br>";
        echo "<br><label>zdjęcie produktu: </label><br>";
        echo "<input type='submit' name='edit_kat' value='Wyslij'><br><br>";
        echo "</form>";
    }

    function PokazProdukt()
    {
        echo "<form method='post' action='products.php'>";
        echo "<br><br><input type='submit' name='pokaz' value='Pokaż Wszystkie Kategorie'><br><br>";
        echo "</form>";
    }


    // Sprawdzanie Czy Została wywołana metoda POST na elemencie Add_kat
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Add_kat'])) {
        $link;
        $name = $_POST['nazwa'];
        $opis = $_POST['opis'];
        $data_ut = date("Y-m-d H:i:s");
        $data_mod = date("Y-m-d H:i:s");
        $data_wyga = date("Y-m-d H:i:s");
        $netto = $_POST['netto'];
        $vat = $_POST['vat'];
        $sztuki = $_POST['sztuki'];
        $status = $_POST['status'];
        $kategoria = $_POST['katprod'];
        $gabaryt = $_POST['gabaryt'];
        //$zdjecie = $_POST['$zdjecie'];
    
        $sql = "INSERT INTO `produkty` (`id`, `tytul`, `opis`, `data_utworzenia`, `data_modyfikacji`, `data_wygasniecia`, `cena_netto`, `podatek_vat`, `ilosc_sztuk`, `status_dostepnosci`, `kategoria_produktu`, `gabaryt_produktu`) VALUES (NULL, '$name', '$opis', '$data_ut', '$data_mod', '$data_wyga', '$netto', '$vat', '$sztuki', '$status', '$kategoria', '$gabaryt') LIMIT 1";
        if ($link->query($sql) === TRUE) {
            echo "Dodano zawartość do bazy danych.";
            header('Location: products.php');
        } else {
            echo "Błąd: " . $sql . "<br>" . $link->error;
        }
        $link->close();
    }

    // Sprawdzanie Czy Została wywołana metoda POST na elemencie del_kat
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['del_kat'])) {
        $link;
        $name = $_POST['nazwa'];

        $sql = "DELETE FROM `produkty` WHERE `produkty`.`tytul` = $name LIMIT 1";
        if ($link->query($sql) === TRUE) {
            echo "Usunieto zawartość do bazy danych.";
            header('Location: products.php');
        } else {
            echo "Błąd: " . $sql . "<br>" . $link->error;
        }
        $link->close();
    }

    // Sprawdzanie Czy Została wywołana metoda POST na elemencie edit_kat
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_kat'])) {
        $link;
        $name = $_POST['nazwa'];
        $opis = $_POST['opis'];
        $data_mod = date("Y-m-d H:i:s");
        $netto = $_POST['netto'];
        $vat = $_POST['vat'];
        $sztuki = $_POST['sztuki'];
        $status = $_POST['status'];
        $kategoria = $_POST['katprod'];
        $gabaryt = $_POST['gabaryt'];

        $sql = "UPDATE `produkty` SET `tytul` = '$name', `opis` = '$opis', `data_modyfikacji` = '$data_mod', `cena_netto` = '$netto', `podatek_vat` = '$vat', `ilosc_sztuk` = '$sztuki', `status_dostepnosci` = '$status', `kategoria_produktu` = '$kategoria ', `gabaryt_produktu` = '$gabaryt' WHERE `produkty`.`tytul` = $name LIMIT 1";
        if ($link->query($sql) === TRUE) {
            echo "Dodano zawartość do bazy danych.";
            header('Location: products.php');
        } else {
            echo "Błąd: " . $sql . "<br>" . $link->error;
        }
        $link->close();
    }

    // Sprawdzanie Czy Została wywołana metoda POST na elemencie pokaz
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pokaz'])) {
        $link;
        $query = "SELECT * FROM produkty";
        $result = $link->query($query);

        if ($link) {
            // Pobieranie produktów
            $products = [];
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }


        } else {
            echo "Błąd połączenia z bazą danych.";


            $link->close();

        }
        echo "<h2>Lista Produktów</h2>";
        echo "<ul>";

        foreach ($products as $product) {
            echo "<li>ID: {$product['id']}, Nazwa: {$product['tytul']}, Cena: {$product['opis']}</li>";
        }

        echo "</ul>";
    }

    DodajProdukt();
    UsunProdukt();
    EdytujProdukt();
    PokazProdukt();
    ?>

</body>

</html>