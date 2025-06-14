<!DOCTYPE html>
<html lang="pl">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/bin/bootstrap.min.css">
        <script src="/bin/jquery.slim.min.js"></script>
        <script src="/bin/popper.min.js"></script>
        <script src="/bin/bootstrap.bundle.min.js"></script>
        <script src="/bin/jquery.min.js"></script>
        <link rel="stylesheet" href="/css/style.css">
        <script type="text/javascript" src="/js/app.js" defer></script>
    <title>Skład Węgla</title>
</head>

<body>

        <div class="jumbotron text-center">
            Sklep kołki i gwoździe
            <br>Projekt na zaliczenie BD
        </div>

        <div class="row" id="menu">
            <div class="col-md-12">

            <button type="button" link="home.php" class="link btn btn-primary">HOME</button>
            <button type="button" link="klienci.php" class="link btn btn-primary">KLIENCI</button>
            <button type="button" link="towary.php" class="link btn btn-primary">TOWARY</button>
            <button type="button" link="zamowienia.php" class="link btn btn-primary">ZAMÓWIENIA</button> 
            <?php
                session_start();
                if(isset($_SESSION['login'])){
            ?>
                    <button type="button" link="logout.php" class="link btn btn-primary">WYLOGUJ</button>
            <?php
                } 
                else{
            ?>
                    <button type="button" link="logowanie.php" class="link btn btn-primary">ZALOGUJ</button>
            <?php
                } ;
            ?>



            </div>
        </div>

        <div class="row.p p-1 ml-5 mr-5 mt-2 mb-2" id="main">
            <div class="text_title">Witaj w sklepie z ......</div>
        </div>

        <div class="row" id="footer">
            <div class="col-md-6">(c) Patryk Wilk 2025</div>
            <div class="col-md-6">All Right Reserved.</div>
        </div>
    

    
</body>
</html>