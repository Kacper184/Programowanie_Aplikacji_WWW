<?php

// ===================================================
// showpage.php Pokazuje nam podstrone o konkretnym ID
// ===================================================

// Dodanie pliku konfiguracyjnego bazy danych oraz podłącznie do niej
include 'cfg.php';

// Funkcja Pokazująca strone o podanym ID
function PokazPodstrone($id)
{
    // Zainicjowanie połączenia z bazą danych
    global $link;
    // Zabezpieczenie przed code injection
    $id_clear = htmlspecialchars($id);

    $query = "SELECT * FROM page_list where id='$id_clear' LIMIT 1";
    $result = $link->query($query);
    $row = $result->fetch_assoc();

    // Sprawdzanie czy strona o id istnieje
    if (empty($row['id'])) {
        $web = '<h1>[nie_znaleziono_strony]</h1>';
    } else {
        $web = $row['page_content'];
    }

    return $web;
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    // Wywołanie funkcji wyświetlającej konkretną podstorne o podanym ID
    echo PokazPodstrone('4');
    ?>
</body>

</html>