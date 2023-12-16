<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_forms.css">
</head>

<body>

    <?php

    // ===================================================
    // Strona generująca formularz kontaktowy oraz
    // Wysyłająca maila do admina strony
    // ===================================================
    
    // Funkcja tworzy formularz kontaktowy
    function PokazKontakt()
    {
        echo "<form method='post' action='contact.php'>";
        echo "<h1>Skontaktuj się z nami !</h1>";
        echo "<br><label>Tytuł: </label><br>";
        echo "<input type='text' name='tytul' required><br>";
        echo "<br><label>E-mail: </label><br>";
        echo "<input type='text' name='mail' required><br>";
        echo "<label>Tresc</label><br>";
        echo "<textarea rows='4' cols='50' name='tresc' required></textarea><br>";
        echo "<input type='submit' name='send' value='Wyslij'><br><br>";
        echo "</form>";
    }

    // Funkcja Wysyła maila na podany adres email
    function WyslijMailKontakt()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {
            $subject = $_POST['tytul'];
            $message = $_POST['tresc'];
            $email = $_POST['mail'];
            $go_to = '164438@student.uwm.edu.pl';
            @ini_set("sendmail_from", $_POST['mail']);
            @mail($go_to, $subject, $message, $email);
            echo "Wiadomość wysłana ! Dziękujemy za kontakt";
        }
    }

    // Funkcja do przypominania hasła za pomocą funckji WyslijMailKontakt()
    function PrzypomnijHaslo()
    {
        echo "<form method='post' action='contact.php'>";
        echo "<input type='submit' name='fo_pass' class='fo_pass'  value='Zapomniałem Hasła'><br>";
        echo "</form>";
        // Sprawdzanie Czy Została wywołana metoda POST na elemencie fo_pass
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fo_pass'])) {
            echo "<form method='post' action='contact.php'>";
            echo "<h1>Przypomnij Hasło</h1>";
            echo "<br><label>Tytuł: </label><br>";
            echo "<input type='text' name='tytul' required value='Odzyskanie Hasła'><br>";
            echo "<br><label>E-mail: </label><br>";
            echo "<input type='text' name='mail' required><br>";
            echo "<label>Tresc</label><br>";
            echo "<textarea rows='4' cols='50' name='tresc' required>Proszę o odzyskanie mojego Hasła</textarea><br>";
            echo "<input type='submit' name='send' value='Wyslij'><br>";
            echo "</form>";
        }
    }

    // Zastosowanie Funckji na stronie
    PokazKontakt();
    WyslijMailKontakt();
    PrzypomnijHaslo();
    ?>

</body>

</html>