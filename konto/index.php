<?php
    /*otworzenie sesji i sprawdzanie czy użytkownik jest zalogowany*/ 
    session_start();
    if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
    {
        header('Location: konto.php');
        /*po spełnienu if nie wykonujemy reszty kodu i odsyłamy użytkownika do konto.php*/
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konto - TechTornado.pl</title>
    <link rel="stylesheet" href="css_index.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <script src="myscripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="shortcut icon" href="ikona_TT.pl.png"/>
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
        <div class="div_zaloguj">
            <p><h3>Zaloguj się do sklepu internetowego TechTornado.pl !</h3></p>
            <form action="zaloguj.php" method="post">
                Login: <br> <input type="text" name="login"/> <br><br>
                Hasło: <br> <input type="password" name="haslo"/> <br> 
                <?php
                    if(isset($_SESSION['blad']))
                    echo $_SESSION['blad'];
                ?><br><br>
                <input type="submit" value="Zaloguj się" class="zaloguj"/>
            </form><br>
        </div>
        <div class="div_zarejestruj">
            <p><h3>Jeśli nie masz konta możesz je założyć za darmo klikając przycisk poniżej !</h3></p><br>
            <img src="logo_TT.pl.png" class="img_rej"><br>
            <a href="rejestracja.php">
                <button class="zarejestruj_button">Zarejestruj się</button>
            </a><br><br>
        </div><br>
    </div><br>
    <div class="stopka">
        Copyright © 2023 Sklep Internetowy TechTornado.pl
    </div>

</body>
</html>