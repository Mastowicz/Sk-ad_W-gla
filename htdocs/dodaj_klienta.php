<?php

    include 'dbconfig.php';

    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $tel = $_POST['nr_tel'];


    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    }

    $zapytanie = "INSERT INTO `klienci` (`id`, `imie`, `nazwisko`, `nr_tel`) VALUES (NULL, '$imie', '$nazwisko', '$tel')";

    $result = $conn->query($zapytanie) or die("". $conn->error);

    $conn->close();

    echo "<tr><td></td><td>$imie</td><td>$nazwisko</td><td>$tel</td><td></td><td></td></tr>"

?>