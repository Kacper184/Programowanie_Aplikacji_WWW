<?php
    // Rozpoczęcie sesji potrzebnej do Logowania/Wylogowania
    session_start();

    // Dodanie pliku konfiguracyjnego bazy danych oraz podłącznie do niej
    include '../cfg.php';

    // Funkcja Tworząca formularz logowania
    function FormularzLogowania() {
        echo '<form method="post" action="admin.php">';
        echo '<label>Login:</label><br>';
        echo '<input type="text" name="username" required><br>';
        echo '<label">Hasło:</label><br>';
        echo '<input type="password" name="password" required><br>';
        echo '<input type="submit" value="Zaloguj"><br>';
        echo '</form>';
    }

    // Sprawdzanie czy użytkownik jest zalogowany jeśli tak to przechodzi dalej jeśli nie wyświetla formularz logowania
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            // Sprawdzanie Poprawności Hasła i loginu
            if ($username === $login && $password === $pass) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = $username;
                header('Location: admin.php');
                exit();
            } else {
                echo "Błędne dane logowania. Spróbuj ponownie.";
                FormularzLogowania();
            }
        } else {
            FormularzLogowania();
        }
    } else {
        echo "Witaj, ".$_SESSION['user']." :)";
        echo '<form method="post" action="admin.php"><input type="submit" name="logout" value="Wyloguj się"></form>';
        // Sprawdzanie Czy Została wywołana metoda POST na elemencie add_content
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_content'])) {
            $title = $_POST['tytul'];
            $content = $_POST['tresc'];
            $active = isset($_POST['active']) ? 1 : 0; 
        
            $sql = "INSERT INTO page_list (page_title, page_content, status) VALUES ('$title', '$content', '$active') LIMIT 1";
        
            if ($link->query($sql) === TRUE) {
                echo "Dodano zawartość do bazy danych.";
                header('Location: admin.php');
            } else {
                echo "Błąd: " . $sql . "<br>" . $link->error;
            }
        }

        // Sprawdzanie Czy Została wywołana metoda POST na elemencie edit_content
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_content'])) {
            $title = $_POST['tytul'];
            $content = $_POST['tresc'];
            $active = isset($_POST['active']) ? 1 : 0; 
        
            $sql = "UPDATE `page_list` SET `page_content` = '$content' WHERE `page_title` = '$title' LIMIT 1";
        
            if ($link->query($sql) === TRUE) {
                echo "Dodano zawartość do bazy danych.";
                header('Location: admin.php');
            } else {
                echo "Błąd: " . $sql . "<br>" . $link->error;
            }
        }

        // Sprawdzanie Czy Została wywołana metoda POST na elemencie delate_content
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delate_content'])) {
            $id = $_POST['id'];
            $content = $_POST['tresc'];
            $active = isset($_POST['active']) ? 1 : 0; 
        
            $sql = "DELETE FROM page_list WHERE `page_list`.`id` = '$id' LIMIT 1";
        
            if ($link->query($sql) === TRUE) {
                echo "Dodano zawartość do bazy danych.";
                header('Location: admin.php');
            } else {
                echo "Błąd: " . $sql . "<br>" . $link->error;
            }
        }
        
        // Funkcja Edytuje Podstrone o konkretnym tytule
        function EdytujPodstrone() {
            echo "<form method='post' action='admin.php'>";
            echo "<h1>Edytuj podstrone</h1>";
            echo "<br><label>Tytul</label><br>";
            echo "<input type='text' name='tytul'><br>";
            echo "<label>Tresc</label><br>";
            echo "<textarea rows='4' cols='50' name='tresc'></textarea><br>";
            echo "<label'>Czy Aktywna ? </label>";
            echo "<input type='checkbox' name='active' value='1'><br>";
            echo "<input type='submit' name='edit_content' value='Edytuj'><br>";
            echo "</form><br><br>";
        }
        
        // Funkcja Dodaje nową podstronę do bazy danych
        function DodajNowaPodstrone() {
            echo "<form method='post' action='admin.php'>";
            echo "<h1>Dodaj Nowa podstrone</h1>";
            echo "<br><label>Tytul</label><br>";
            echo "<input type='text' name='tytul'><br>";
            echo "<label>Tresc</label><br>";
            echo "<textarea rows='4' cols='50' name='tresc'></textarea><br>";
            echo "<label>Czy Aktywna ? </label>";
            echo "<input type='checkbox' name='active' value='1'><br>";
            echo "<input type='submit' name='add_content' value='Dodaj'><br>";
            echo "</form>";
        }
        
        // Funkcja usuwająca podstronę o danym przez użytkownika ID
        function UsunPodstrone() {
            echo "<form method='post' action='admin.php'>";
            echo "<h1>Usun podstrone</h1>";
            echo "<br><label>ID</label><br>";
            echo "<input type='text' name='id'><br>";
            echo "<input type='submit' name='delate_content' value='Usun'><br>";
            echo "</form>";
        }
        
        // Niszczy sesje po wylogowaniu
        if (isset($_POST['logout'])) {
            session_destroy();
            header('Location: admin.php');
            exit();
        }
        
    //Zastosowanie funckji na stronie        
    DodajNowaPodstrone();
    EdytujPodstrone();
    UsunPodstrone();
    //Wyświetla wszystko z bazy danych
    $query_list = 'SELECT * FROM page_list LIMIT 100';
    $result_list = $link->query($query_list);
    while($row = $result_list->fetch_assoc())
    {
        echo $row['id'].' '.$row['page_title'].'<br>';
    } 
    }
    // Zamykanie połączenia z bazą danych
    $link->close();
?>