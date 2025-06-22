<?php
    /*otworzenie sesji i sprawdzanie czy użytkownik jest zalogowany*/ 
    session_start();
    if(!isset($_SESSION['Rejestracja przebiegła prawidłowo'])) 
    {
        header('Location: index.php');
        exit();
    }
    else
    {
        unset($_SESSION['Rejestracja przebiegła prawidłowo']);
    }

    /*Usuwanie zmiennych przy poprawnej walidacji czyli przy poprawnej rejestracji w celu zwolnienia pamięci*/
    if(isset($_SESSION['zapamietaj_imie'])) unset($_SESSION['zapamietaj_imie']);
    if(isset($_SESSION['zapamietaj_nazwisko'])) unset($_SESSION['zapamietaj_nazwisko']);
    if(isset($_SESSION['zapamietaj_login'])) unset($_SESSION['zapamietaj_login']);
    if(isset($_SESSION['zapamietaj_email'])) unset($_SESSION['zapamietaj_email']);
    if(isset($_SESSION['zapamietaj_tel'])) unset($_SESSION['zapamietaj_tel']);

    /*Usuwanie bledów rejestracji w celu zwolnienia pamięci*/
    if(isset($_SESSION['blad_login'])) unset($_SESSION['blad_login']);
    if(isset($_SESSION['blad_mail'])) unset($_SESSION['blad_mail']);
    if(isset($_SESSION['blad_numer'])) unset($_SESSION['blad_numer']);
    if(isset($_SESSION['blad_haslo'])) unset($_SESSION['blad_haslo']);
    if(isset($_SESSION['blad_powtorz_haslo'])) unset($_SESSION['blad_powtorz_haslo']);
    if(isset($_SESSION['blad_regulamin'])) unset($_SESSION['blad_regulamin']);
    if(isset($_SESSION['blad_recaptcha'])) unset($_SESSION['blad_recaptcha']);

?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Witaj - TechTornado.pl</title>
    <link rel="stylesheet" href="css_witaj.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <script src="myscripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="shortcut icon" href="ikona_TT.pl.png"/>
</head>
<header class="navigation">
    <nav class="navigation">
        <ul class="nav-bar">
        <li class="logo"><img src="logo_TT.pl.png"></li>
        <input type="checkbox" id="check">
        <span class="menu">
            <li><a a href="http://techtornado.w.zset.leszno.pl"><i class="fa-solid fa-house"></i>   Strona główna</a></li>
            <li><a a href="file:///Users/kacperrozwalka/Różne_rzeczy/Projekt_praktyki/Produkty/produkty.html"><i class="fa-solid fa-bag-shopping"></i>   Produkty</a></li>
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
<body>
<div class="tresc">
    <p class="p_tresc">Dziękujemy za rejestrację w sklepie internetowym TechTornado.pl ! <br>
    Możesz się teraz zalogować na swoje konto.</p><br>
    <a href="index.php">
        <button class="zaloguj">Zaloguj się</button>
    </a><br>
    <img src="logo_TT.pl.png" class="logo_d">
</div><br>
<div class="stopka">
    Copyright © 2023 Sklep Internetowy TechTornado.pl
</div>
</body>
</html>