<?php

    include 'cfg.php';

    function PokazPodstrone($id)
    {

        global $link;

        $id_clear = htmlspecialchars($id);

        $query = "SELECT * FROM page_list where id='$id_clear' LIMIT 1";
        $result = $link->query($query);
        $row = $result->fetch_assoc();

        if(empty($row['id']))
        {
            $web = '<h1>[nie_znaleziono_strony]</h1>';
        }
        else
        {
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
        echo PokazPodstrone('4');
    ?>
</body>
</html>