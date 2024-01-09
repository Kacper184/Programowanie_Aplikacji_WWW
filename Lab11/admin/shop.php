<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_forms.css">
</head>

<body>

    <?php

    // ===================================================
    // Strona Pozwalająca edytowac/usuwac/dodawać Kategorie
    // Posługujemy się bazą danych o kolumnach
    // ID | Matka | Nazwa
    // Typy danych to auto_increment, Int, varchar 255
    // ===================================================
    
    include '../cfg.php';

    // Funkcja tworząca formualrz do dodawania Kategorii
    function DodajKategorie()
    {
        echo "<form method='post' action='shop.php'>";
        echo "<h1>Dodaj Nową Kategorię</h1>";
        echo "<br><label>Nazwa: </label><br>";
        echo "<input type='text' name='nazwa' required><br>";
        echo "<br><label>Matka: </label><br>";
        echo "<input type='text' name='matka' required><br><br>";
        echo "<input type='submit' name='Add_kat' value='Wyslij'><br><br>";
        echo "</form>";
    }

    // Funkcja tworząca formualrz do Usuwania Kategorii
    function UsunKategorie()
    {
        echo "<form method='post' action='shop.php'>";
        echo "<h1>Usuń Kategorię</h1>";
        echo "<br><label>Nazwa: </label><br>";
        echo "<input type='text' name='nazwa' required><br>";
        echo "<input type='submit' name='del_kat' value='Wyslij'><br><br>";
        echo "</form>";
    }

    // Funkcja tworząca formualrz do Edytowania Kategorii
    function EdytujKategorie()
    {
        echo "<form method='post' action='shop.php'>";
        echo "<h1>Edytuj Nową Kategorię</h1>";
        echo "<br><label>Nazwa: </label><br>";
        echo "<input type='text' name='nazwa' required><br>";
        echo "<br><label>Matka: </label><br>";
        echo "<input type='text' name='matka' required><br>";
        echo "<br><label>Id elementu do zmiany: </label><br>";
        echo "<input type='text' name='id' required><br><br>";
        echo "<input type='submit' name='edit_kat' value='Wyslij'><br><br>";
        echo "</form>";
    }

    function PokazKategorie()
    {
        echo "<form method='post' action='shop.php'>";
        echo "<br><br><input type='submit' name='pokaz' value='Pokaż Wszystkie Kategorie'><br><br>";
        echo "</form>";
    }


    // Sprawdzanie Czy Została wywołana metoda POST na elemencie Add_kat
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Add_kat'])) {
        $link;
        $name = $_POST['nazwa'];
        $matka = $_POST['matka'];

        $sql = "INSERT INTO shop (matka, nazwa) VALUES ('$matka', '$name') LIMIT 1";
        if ($link->query($sql) === TRUE) {
            echo "Dodano zawartość do bazy danych.";
            header('Location: shop.php');
        } else {
            echo "Błąd: " . $sql . "<br>" . $link->error;
        }
        $link->close();
    }

    // Sprawdzanie Czy Została wywołana metoda POST na elemencie del_kat
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['del_kat'])) {
        $link;
        $name = $_POST['nazwa'];

        $sql = "DELETE FROM shop WHERE `shop`.`nazwa` = '$name' LIMIT 1";
        if ($link->query($sql) === TRUE) {
            echo "Dodano zawartość do bazy danych.";
            header('Location: shop.php');
        } else {
            echo "Błąd: " . $sql . "<br>" . $link->error;
        }
        $link->close();
    }

    // Sprawdzanie Czy Została wywołana metoda POST na elemencie edit_kat
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_kat'])) {
        $link;
        $name = $_POST['nazwa'];
        $matka = $_POST['matka'];
        $id = $_POST['id'];

        $sql = "UPDATE `shop` SET `matka` = '$matka', `nazwa` = '$name' WHERE `shop`.`id` = '$id' LIMIT 1";
        if ($link->query($sql) === TRUE) {
            echo "Dodano zawartość do bazy danych.";
            header('Location: shop.php');
        } else {
            echo "Błąd: " . $sql . "<br>" . $link->error;
        }
        $link->close();
    }

    // Sprawdzanie Czy Została wywołana metoda POST na elemencie pokaz
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pokaz'])) {
        $link;

        if ($link) {
            // Pobieranie kategorii głównych (matki)
            $query = "SELECT * FROM shop WHERE matka = 0";
            $result = $link->query($query);
        
            if ($result) {
                while ($mainCategory = $result->fetch_assoc()) {
                    echo "<b>{$mainCategory['nazwa']}</b><br>";
        
                    // Pobieranie podkategorii (dzieci)
                    $subQuery = "SELECT * FROM shop WHERE matka = {$mainCategory['id']}";
                    $subResult = $link->query($subQuery);
        
                    if ($subResult) {
                        while ($subCategory = $subResult->fetch_assoc()) {
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;{$subCategory['nazwa']}<br>";
                        }
                        $subResult->free();
                    } else {
                        echo "Błąd zapytania podkategorii: " . $link->error;
                    }
        
                    echo "<br>";
                }
                $result->free();
            } else {
                echo "Błąd zapytania głównych kategorii: " . $link->error;
            }
        } else {
            echo "Błąd połączenia z bazą danych.";
        }

        $link->close();
    }

    DodajKategorie();
    UsunKategorie();
    EdytujKategorie();
    PokazKategorie();
    ?>

</body>

</html>