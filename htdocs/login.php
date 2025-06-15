<meta http-equiv="refresh" content="2;url=index.php"/>
<?php

    $login = $_POST['login'];
    $haslo = SHA1($_POST['haslo']);

    include 'dbconfig.php';

    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    };

    $zapytanie = "SELECT * FROM `uzytkownicy` WHERE `login`='$login' AND `haslo`='$haslo'";

    $result = $conn->query($zapytanie);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            session_start();
            $_SESSION['login'] = $row['login'];
            $_SESSION['haslo'] = $row['haslo'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['imie'] = $row['imie'];
            $_SESSION['nazwisko'] = $row['nazwisko'];
            $_SESSION['administrator'] = $row['administrator'];
        }
    } else {
        echo "0 results";
    }

    $conn->close();

    if(isset($_SESSION['login'])){
        echo "Witaj ".$_SESSION['imie']." ".$_SESSION['nazwisko']."<br>";
    };

?>