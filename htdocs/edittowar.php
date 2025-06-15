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

<script>
    function validateTextarea() {
            const pattern = /^[A-Za-z0-9 ]+$/;
            const textarea = document.getElementById('opis');
        if (!pattern.test(textarea.value)) {
            alert("Dozwolone są tylko litery, cyfry i spacje");
            return false;
        }
        return true;
    }
</script>

<?php

    include 'dbconfig.php';

    $id = $_GET['id'];

    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    }

    $zapytanie = "SELECT * FROM towary WHERE `towary`.`id` = $id LIMIT 1;";
                
    $result = $conn->query($zapytanie);

            if ($result->num_rows > 0) {
            
                while ($row = $result->fetch_assoc()) {

?>

<div>
    <form onsubmit="return validateTextarea()" method="post" id="myForm" action="zapisz_dodaj_towar.php">
        <div class="form-group">
            <input type="text" name="id" value="<?php echo $row['id'];?>" hidden>
            <label for="nazwa">Nazwa:</label>
            <input type="text" pattern="[A-Ż,a-ż]{1,80}" class="form-control mb-3" id="nazwa" name="nazwa" value="<?php echo $row['nazwa'];?>" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="cena">Cena:</label>
            <input type="text" pattern="[0-9]{1,9}" class="form-control mb-3" id="cena" name="cena" value="<?php echo $row['cena'];?>" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="opis">Opis:</label>
            <textarea type="text" class="form-control mb-3" id="opis" name="opis" autocomplete="off"><?php echo $row['opis'];?></textarea>
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