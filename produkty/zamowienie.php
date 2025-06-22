<?php
    session_start();
    if(isset($_POST['mail']))
    {
        $wszystko_ok=true;

        /*sprawdzanie poprawnośći nr_tel (9 liczb)*/
        $nr_tel = $_POST['nr_tel'];
        if ((string)strlen($nr_tel) != 9)
        {
            $wszystko_ok = false;
            $_SESSION['blad_numer']="Niepoprawny numer telefonu";
        }

        /*przypisanie do zmiennych imienia i nazwiska*/
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        if(!isset($imie)){
            $wszystko_ok = false;
            $_SESSION['blad_imie'] = "Proszę podać Imię";
        }
        if(!isset($nazwisko)){
            $wszystko_ok = false;
            $_SESSION['blad_nazwisko'] = "Proszę podać Nazwisko";
        }

        /*poprawność adresu e-mail*/
        $email = $_POST['mail'];
        /*filrtowanie sanetyzacji adresu email*/
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
        if ((filter_var($emailB, FILTER_SANITIZE_EMAIL)==false) || ($emailB!=$email))
        {
            $wszystko_ok = false;
            $_SESSION['blad_mail']="Zły adres email";
        }
        if (!isset($_POST['regulamin']))
        {
            $wszystko_ok = false;
            $_SESSION['blad_regulamin']="Musisz zaakceptować regulamin!";
        }

        if (!isset($_POST['rodo']))
        {
            $wszystko_ok = false;
            $_SESSION['blad_rodo']="Musisz potwierdzić RODO!";
        }
        $kod = $_POST['kod'];
        if (!isset($kod) || ! preg_match('/^[0-9]{2}-?[0-9]{3}$/Du', $kod)){
            $wszystko_ok = false;
            $_SESSION['blad_kod']="Zły kod pocztowy!";
        }
    

        $_SESSION['zapamietaj_imie'] = $imie;
        $_SESSION['zapamietaj_nazwisko'] = $nazwisko;
        $_SESSION['zapamietaj_login'] = $login;
        $_SESSION['zapamietaj_email'] = $email;
        $_SESSION['zapamietaj_tel'] = $nr_tel;
        $_SESSION['zapamietaj_kod'] = $kod;
    }
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacje do zamówienia - TechTornado.pl</title>
    <link rel="stylesheet" href="css_zamowienie.css">
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
            <li><a a href="http://techtornado.w.zset.leszno.pl"><i class="fa-solid fa-house"></i>   Strona główna</a></li>
            <li><a a href="http://techtornado.w.zset.leszno.pl/produkty"><i class="fa-solid fa-bag-shopping"></i>   Produkty</a></li>
            <li><a a href="http://techtornado.w.zset.leszno.pl/konto/"><i class="fa-solid fa-user"></i></i>   Konto</a></li>
            <li><a a href="http://techtornado.w.zset.leszno.pl/regulamin/"><i class="fa-solid fa-clipboard"></i>   Regulamin</a></li>
            <li><a a href="http://techtornado.w.zset.leszno.pl/kontakt/"><i class="fa-solid fa-phone"></i>   Kontakt</a></li>
            <li><a a href="http://techtornado.w.zset.leszno.pl/o-nas/"><i class="fa-solid fa-circle-info"></i>   O nas</a></li>
            <li><a a href="http://techtornado.w.zset.leszno.pl/produkty/koszyk"><i class="fa-solid fa-basket-shopping"></i>   Koszyk</a></li>
            <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
        </span>
        <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
        </ul>
	</nav>
    </header>
    <div class="tresc">
        <h2>Podaj potrzebne informacje do zamówienia: </h2>
        <div class="zamowienie">
            <form method="post">
                Imię: <br> <input type="text" placeholder="(wymagane)" value="<?php 
                if (isset($_SESSION['zapamietaj_imie'])) 
                {
                    echo $_SESSION['zapamietaj_imie'];
                    unset($_SESSION['zapamietaj_imie']);
                } 
                ?>"  name="imie"/> <br><br>
                <?php
                if(isset($_SESSION['blad_imie']))
                {
                    echo '<div class="error">'.$_SESSION['blad_imie'].'</div>';
                    unset($_SESSION['blad_imie']);
                }
                ?>
                Nazwisko: <br> <input type="text" placeholder="(wymagane)" value="<?php 
                if (isset($_SESSION['zapamietaj_nazwisko'])) 
                {
                    echo $_SESSION['zapamietaj_nazwisko'];
                    unset($_SESSION['zapamietaj_nazwisko']);
                } 
                ?>" name="nazwisko"/> <br><br>
                <?php
                if(isset($_SESSION['blad_nazwisko']))
                {
                    echo '<div class="error">'.$_SESSION['blad_nazwisko'].'</div>';
                    unset($_SESSION['blad_nazwisko']);
                }
                ?>
                E-mail: <br> <input type="text" placeholder="(wymagane)" value="<?php 
                if (isset($_SESSION['zapamietaj_email'])) 
                {
                    echo $_SESSION['zapamietaj_email'];
                    unset($_SESSION['zapamietaj_email']);
                } 
                ?>" name="mail"/> <br><br>
                <?php
                if(isset($_SESSION['blad_mail']))
                {
                    echo '<div class="error">'.$_SESSION['blad_mail'].'</div>';
                    unset($_SESSION['blad_mail']);
                }
                ?>
                Numer telefonu: <br> <input type="text" placeholder="(wymagane)" value="<?php 
                if (isset($_SESSION['zapamietaj_tel'])) 
                {
                    echo $_SESSION['zapamietaj_tel'];
                    unset($_SESSION['zapamietaj_tel']);
                } 
                ?>" name="telefon"/> <br><br>
                <?php
                if(isset($_SESSION['blad_numer']))
                {
                    echo '<div class="error">'.$_SESSION['blad_numer'].'</div>';
                    unset($_SESSION['blad_numer']);
                }
                ?>
                Ulica: <br> <input type="text" placeholder="(wymagane)" name="ulica"/> <br><br>
                Numer domu / mieszkania: <br> <input type="text" placeholder="(wymagane)" name="dom"/> <br><br>
                Kod pocztowy: <br> <input type="text" placeholder="(wymagane)" value="<?php 
                if (isset($_SESSION['zapamietaj_kod'])) 
                {
                    echo $_SESSION['zapamietaj_kod'];
                    unset($_SESSION['zapamietaj_kod']);
                } 
                ?>" name="kod"/> <br><br>
                <?php
                if(isset($_SESSION['blad_kod']))
                {
                    echo '<div class="error">'.$_SESSION['blad_kod'].'</div>';
                    unset($_SESSION['blad_kod']);
                }
                ?>
                Miejscowość: <br> <input type="text" placeholder="(wymagane)" name="miejscowosc"/> <br><br>
                <label>
                    <input type="checkbox" name="regulamin" class="check"/> Akceptuje regulamin (<a href="https://techtornado.w.zset.leszno.pl/regulamin/" target="_blank">Regulamin</a>) <br>
                </label>
                <?php
                    if(isset($_SESSION['blad_regulamin']))
                    {
                        echo '<div class="error">'.$_SESSION['blad_regulamin'].'</div>';
                        unset($_SESSION['blad_regulamin']);
                    }
                ?>
                <label>
                    <input type="checkbox" name="rodo" class="check"/> Wyrażam zgodę na przetwarzanie danych osobowych (RODO)  
                </label><br>
                <?php
                    if(isset($_SESSION['blad_rodo']))
                    {
                        echo '<div class="error">'.$_SESSION['blad_rodo'].'</div>';
                        unset($_SESSION['blad_rodo']);
                    }
                ?><br>
                <div class="podsumowanie">
                    <p class="p_podsumowanie"><b>Suma twoich zakupów: 84 000 zł</b></p>
                    <button type="submit" value="Zamawiam" class="zamawiam" action=""><i class="fa-solid fa-money-bill-wave fa-beat"></i> &nbsp; <b>ZAMAWIAM</b></button>
                </div><br>
            </form>
        </div><br>
        
        <div class="zalety">
            <p><h1>Dlaczego warto założyć konto w TechTornado ?</h1></p>
            <p class="p_tresc">1. Szybsze Zakupy
    
            Kiedy masz konto w TechTornado.pl, Twoje dane kontaktowe i adres dostawy są zapisane, co oznacza, że nie musisz ich wprowadzać za każdym razem, gdy robisz zakupy. To sprawia, że proces zakupowy jest szybszy i bardziej wygodny.<br><br>
    
            2. Śledzenie Zamówień<br><br>
    
            Założenie konta pozwala Ci na bieżące śledzenie statusu swoich zamówień. Dowiesz się, kiedy Twoje zamówienie zostało zrealizowane i kiedy możesz spodziewać się dostawy.<br><br>
    
            3. Historia Zakupów<br><br>
    
            Konto umożliwia przechowywanie historii Twoich zakupów. Możesz łatwo sprawdzić, co wcześniej kupiłeś i ponownie zamówić ulubione produkty.</p><br>
            <img src="logo_TT.pl.png" class="img_zalety"><br>
        <a href="http://techtornado.w.zset.leszno.pl/konto/">
            <button class="zaloguj">Zaloguj się</button>
        </a>
        </div>
    </div><br>
    <div class="stopka">
        Copyright © 2023 Sklep Internetowy TechTornado.pl
    </div>
</body>
</html>