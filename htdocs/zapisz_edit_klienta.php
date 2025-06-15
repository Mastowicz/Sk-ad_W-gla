<meta http-equiv="refresh" content="1;url=index.php"/>

<?php

    include 'dbconfig.php';

    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $tel = $_POST['nr_tel'];
    $id= $_POST['id'];


    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    }

    $zapytanie = "UPDATE `klienci` SET `imie` = '$imie', `nazwisko` = '$nazwisko', `nr_tel` = '$tel' WHERE `klienci`.`id` = $id;";

    $result = $conn->query($zapytanie);

    $conn->close();
?>