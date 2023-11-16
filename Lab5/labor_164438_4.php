<?php
session_start();
$nr_indeksu = '164438';
$nr_grupy = '4';
echo 'Kacper Wach '.$nr_indeksu.' grupa: '.$nr_grupy.'<br/><br/>';
echo 'Zastosowanie metody include() <br/>';
include 'plik.php';
echo '<br/>Zastosowałem requre_once<br/>';
require_once 'plik2.php';

echo '<br/>Zastosowanie If, else, elseif, switch: <br/>';

$quantity = 4;
$broken = 2;

if ($quantity > $broken) {
    echo 'Good';
} elseif ($quantity == $broken) {
    echo 'Please Check';
} else {
    echo 'Bad plis order';
}

echo '<br/><br/>';

$kind_of_fruit = 'B';

switch ($kind_of_fruit) {
    case 'A':
        echo 'Banan';
        break;
    case 'B':
        echo 'Mandarynka';
        break;
    case 'C':
        echo 'Jablko';
        break;
}

echo '<br/>Zastosowanie While(), for() <br/>';

$i = 10;
while ($i >= 0) {
    echo 'Odliczanie'.$i.'<br/>';
    $i--;
}

for($j = 0; $j <= 10; $j++) {
    $random_color = "background-color:rgb(255,".(255 - $j*20).",255)";
;   echo "<p style='$random_color'>Tekst kolorowy</p>";
}

echo '<br/>Zastosowanie $_GET $_POST $_SESSION <br/>';

if(isset($_GET['name'])) {
    echo 'Dzień Dobry '.htmlspecialchars($_GET["name"]);
}

if(isset($_POST['name']) && isset($_POST['email'])) {
    echo "Imie: $name";
    echo "Email: $email";
} else {
    echo 'Brak Danych';
}

echo '<br/>';
$_SESSION['Fruit'] = 'Mango';
$read = $_SESSION['Fruit'];
echo 'Owoc w superglobalnej tablicy to: '.$read;
?>