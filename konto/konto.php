<?php
    session_start();

    if(!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        /*brak wykonania reszty skryptu, ponieważ nie jesteśmy zalogowani*/
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szczegóły konta - TechTornado.pl</title>
    <link rel="stylesheet" href="css_konto.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <script src="myscripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="shortcut icon" href="ikona_TT.pl.png"/>
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
<header class="navigation">
    <nav class="navigation">
        <ul class="nav-bar">
        <li class="logo"><img src="logo_TT.pl.png"></li>
        <input type="checkbox" id="check">
        <span class="menu">
            <li><a a href="http://techtornado.w.zset.leszno.pl"><i class="fa-solid fa-house"></i>   Strona główna</a></li>
            <li><a a href="http://techtornado.w.zset.leszno.pl/produkty/"><i class="fa-solid fa-bag-shopping"></i>   Produkty</a></li>
            <li><a a href="http://techtornado.w.zset.leszno.pl/konto/"><i class="fa-solid fa-user"></i></i>   Konto</a></li>
            <li><a a href="http://techtornado.w.zset.leszno.pl/regulamin/"><i class="fa-solid fa-clipboard"></i>   Regulamin</a></li>
            <li><a a href="http://techtornado.w.zset.leszno.pl/kontakt/"><i class="fa-solid fa-phone"></i>   Kontakt</a></li>
            <li><a a href="http://techtornado.w.zset.leszno.pl/o-nas/"><i class="fa-solid fa-circle-info"></i>   O nas</a></li>
            <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
        </span>
        <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
        </ul>
	</nav>
    </header>
    <div class="tresc">
        <?php
            echo "<p><b>Witaj </b>".$_SESSION['user']. ' '.$_SESSION['nazwisko'].'! </p>';
            echo "<p><b>Twój login to: </b>".$_SESSION['login']."</p>";
            echo "<p><b>E-mail do konta: </b>".$_SESSION['email']."</p>";
            echo "<p><b>Numer telefonu: </b>".$_SESSION['nr_telefonu']."</p>";
        ?>
        <a href="logout.php">
            <button class="wyloguj_button">Wyloguj się</button>
        </a>
        <p>
            <h2>Historia twoich zakupów:</h2>
            Macbook Air M1 Data: 11.11.2023r.
        </p>
    </div><br>
    <div class="stopka">
        Copyright © 2023 Sklep Internetowy TechTornado.pl
    </div>
</body>
</html>