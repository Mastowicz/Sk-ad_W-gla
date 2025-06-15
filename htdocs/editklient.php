<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/bin/bootstrap.min.css">
        <script src="/bin/popper.min.js"></script>
        <script src="/bin/bootstrap.bundle.min.js"></script>
        <script src="/bin/jquery.min.js"></script>
        <link rel="stylesheet" href="/css/style.css">
    <title>Skład Węgla</title>
</head>

<?php

    include 'dbconfig.php';

    $id = $_GET['id'];

    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    }

    $zapytanie = "SELECT * FROM klienci WHERE `klienci`.`id` = $id LIMIT 1;";
                
    $result = $conn->query($zapytanie);

            if ($result->num_rows > 0) {
            
                while ($row = $result->fetch_assoc()) {

?>

<div>
    <form method="post" id="myForm" action="zapisz_edit_klienta.php">
        <div class="form-group">
            <input type="text" name="id" value="<?php echo $row['id'];?>" hidden>
            <label for="imie">Imie:</label>
            <input type="text" pattern="[A-Ż,a-ż]{1,80}" class="form-control mb-3" id="imie" name="imie" value="<?PHP echo $row['imie'];?>" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="nazwisko">Nazwisko:</label>
            <input type="text" pattern="[A-Ż,a-ż]{1,80}" class="form-control mb-3" id="nazwisko" name="nazwisko" value="<?PHP echo $row['nazwisko'];?>" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="nr_tel">Numer telefonu:</label>
            <input type="text" pattern="[0-9]{9}" class="form-control mb-3" id="nr_tel" name="nr_tel" value="<?PHP echo $row['nr_tel'];?>" autocomplete="off" required>
        </div>

        <button type="reset" class="btn btn-primary">Reset</button>
        <button type="submit" class="btn btn-primary">Popraw</button>
    </form>
</div>

<?php

            }
        } else {
            echo "0 results";
        }

        $conn->close();
?>