<meta http-equiv="refresh" content="1;url=index.php"/>

<?php

    include 'dbconfig.php';

    $klient = $_POST['klient'];
    $towar = $_POST['towar'];
    $ilosc = $_POST['ilosc'];
    $id= $_POST['nr_zamowienia'];


    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    }

    $zapytanie = "UPDATE `zamowienia` SET `id_klienta` = '$klient', `id_towaru` = '$towar', `ilosc` = '$ilosc' WHERE `zamowienia`.`nr_zamowienia` = $id;";

    $result = $conn->query($zapytanie);

    $conn->close();
?>