<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/koszyk.css">
</head>

<body>

    <?php
    session_start();

    // ===================================================
    // Strona Pozwalająca korzystac z koszyka
    // Na podstawie bazy danych produkty
    // ===================================================
    
    include 'cfg.php';

    function PokazProdukty()
    {
        global $link;
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
        echo "<h2>Lista Dostępnych Produktów</h2>";
        echo "<ul>";

        foreach ($products as $product) {
            $imageData = base64_encode($product['zdjecie_produktu']);
            echo "<li>Nazwa: {$product['tytul']}, Cena - netto: {$product['cena_netto']}zł Opis: {$product['opis']}, Ilosc: {$product['ilosc_sztuk']}, Zdjecie: <img src='data:image/jpeg;base64,{$imageData}' alt='Zdjęcie Produktu' width='100' height='100'>";
            echo "<form method='post' action='koszyk.php'>";
            echo "<input type='hidden' name='product_id' value='{$product['id']}'>";
            echo "<input type='hidden' name='tytul' value='{$product['tytul']}'>";
            echo "<input type='hidden' name='cena' value='{$product['cena_netto']}'>";
            echo "<input type='hidden' name='podatek' value='{$product['podatek_vat']}'>";
            echo "<input type='number' name='ilosc' value='1' min='1'>";
            echo "<br><input type='submit' name='DodajDoKoszyka' value='Dodaj do koszyka'><br><br>";
            echo "</form></li>";
        }

        echo "</ul>";

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['DodajDoKoszyka'])) {
            $product_id = $_POST['product_id'];
            $nazwa = $_POST['tytul'];
            $ilosc = $_POST['ilosc'];
            $cena = $_POST['cena'];
            $podatek = $_POST['podatek'];
            $cena = $cena * (1 + ($podatek / 100));

            DodajDoKoszyka($product_id, $nazwa, $ilosc, $cena);
        }

        if (isset($_SESSION['koszyk']) && !empty($_SESSION['koszyk'])) {
            echo "<h3 id='koszyk'>Twój Koszyk</h3>";
            foreach ($_SESSION['koszyk'] as $index => $produkt) {
                echo "<li>{$produkt['tytul']} - Ilość Sztuk: {$produkt['ilosc']} <a href='?action=OdejmijIlosc&index={$index}'>Odejmij</a> - Cena Brutto: {$produkt['cena']} zł <a href='?action=usun&index={$index}'>Usuń z koszyka</a></li>";
            }
        } else {
            echo "<li>Koszyk jest pusty</li>";
        }
        echo "<h3>Suma: " . SumaKoszyka() . " zł</h3>";
        echo "<form method='post' action='koszyk.php'>";
        echo "<input type='submit' name='zrealizuj' value='Zrealizuj'>";
        echo "</form></li>";
    }

    function SumaKoszyka()
    {
        $suma = 0;
        foreach ($_SESSION['koszyk'] as $produkt) {
            $suma += $produkt['cena'] * $produkt['ilosc'];
        }
        return $suma;
    }

    function OdejmijIlosc($index)
    {
        if (isset($_SESSION['koszyk'][$index])) {
            $_SESSION['koszyk'][$index]['ilosc']--;

            if ($_SESSION['koszyk'][$index]['ilosc'] <= 0) {
                unset($_SESSION['koszyk'][$index]);
                $_SESSION['koszyk'] = array_values($_SESSION['koszyk']);
            }
        }
    }

    if (isset($_GET['action']) && $_GET['action'] === 'OdejmijIlosc') {
        $index = $_GET['index'];
        OdejmijIlosc($index);
    }


    function DodajDoKoszyka($produktID, $nazwa, $ilosc, $cena)
    {
        if (!isset($_SESSION['koszyk'])) {
            $_SESSION['koszyk'] = [];
        }

        if (isset($_SESSION['koszyk'][$produktID])) {
            $_SESSION['koszyk'][$produktID]['ilosc'] += $ilosc;
        } else {
            $_SESSION['koszyk'][$produktID] = [
                'tytul' => $nazwa,
                'ilosc' => $ilosc,
                'cena' => $cena,
            ];
        }
    }
    function UsunZKoszyka($index)
    {
        unset($_SESSION['koszyk'][$index]);
        $_SESSION['koszyk'] = array_values($_SESSION['koszyk']);
    }



    if (isset($_GET['action']) && $_GET['action'] === 'usun') {
        $index = $_GET['index'];
        UsunZKoszyka($index);
    }

    PokazProdukty();

    ?>

</body>

</html>