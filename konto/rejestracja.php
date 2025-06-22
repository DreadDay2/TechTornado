<?php
    /*otworzenie sesji i sprawdzanie czy użytkownik jest zalogowany*/ 
    session_start();

    /*czy podany jest mail czyli wartość TRUE*/
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

        /*wymagania wobec loginu użytkownika*/
        $login = $_POST['login'];
        if((strlen($login)<4) || (strlen($login)>20))
        {
            $wszystko_ok = false;
            $_SESSION['blad_login'] = "Login musi posiadać od 4 do 20 znaków";
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

        /*sprawdzanie poprawności hasła*/
        $haslo1 = $_POST['haslo'];
        $haslo2 = $_POST['powtorz_haslo'];
        if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
        {
            $wszystko_ok = false;
            $_SESSION['blad_haslo']="Hasło musi zawierać od 8 do 20 znaków";
        }

        if ($haslo1!=$haslo2)
        {
            $wszystko_ok = false;
            $_SESSION['blad_powtorz_haslo']="Podane hasła nie są identyczne";
        }

        $hashowane_haslo = password_hash($haslo1, PASSWORD_DEFAULT);
        
        /*określenie akcpetacji regualminu; BRAK AKCEPTACJI -> Brak możliwości założenia konta*/
        /*jezeli checkbox nie jest zaznaczony (czyli nie istnieje zmienna regualamin w tablicy POST) to nie przepuszczamy dalej użytkownika*/
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

        /*sprawdzenie czy użytkownik, który zakłada konto nie jest botem, zabezpieczenie przed tworzeniem dużych ilości kont przez boty*/
        /*klucz tajny recaptcha*/
        $klucz_tajny = "6Lcz_gIpAAAAAFeHO0XYoW_YusIq5hb-B9NDc7sl";
        $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$klucz_tajny.'&response='.$_POST['g-recaptcha-response']);

        /*zdekodowanie odpowiedzi, którą otrzymaliśmy z serwera google, która była w formacie .json*/
        $odpowiedz = json_decode($sprawdz);

        /*sprawdzenie czy przeszliśmy test na NIE bycie botem*/ 
        if ($odpowiedz->success==false)
        {
            $wszystko_ok = false;
            $_SESSION['blad_recaptcha']="Musisz potwierdzić, że nie jesteś robotem!";
        }

        /*Zapamiętywanie danych w formularzu w razie nie powodzenia walidacji danych (czyli poprawnego założenia konta)*/
        $_SESSION['zapamietaj_imie'] = $imie;
        $_SESSION['zapamietaj_nazwisko'] = $nazwisko;
        $_SESSION['zapamietaj_login'] = $login;
        $_SESSION['zapamietaj_email'] = $email;
        $_SESSION['zapamietaj_tel'] = $nr_tel;

        /*połączenie z bazą danych (tak jak w pliku zaloguj.php)*/
        require_once 'connect.php';
        /*sposób raportowania błędów , w taki sposób by były wyświetlane wyjątki bez szczegółów dla "normalnych" userów*/
        mysqli_report(MYSQLI_REPORT_STRICT);

        /*inna metoda wyciągnięcia danych z baz danych*/
        try
        {
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if($polaczenie->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                /*Sprawdzenie czy już istnieje e-mail w bazie*/
                $result = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");

                /*wyrzucenie błędu gdy połączenie z bazą danych się nie uda, wyrzucanie wyjątku*/
                if(!$result) throw new Exception($polaczenie->error);

                /*sprawdzenie liczby wierszy: number of rows -> num_rows*/
                $ile_takich_maili = $result->num_rows;
                if($ile_takich_maili>0)
                {
                    $wszystko_ok = false;
                    $_SESSION['blad_mail']="Istnieje już konto zarejstrowane na podany adres e-mail";
                }


                /*Sprawdzenie czy już istnieje numer telefonu w bazie*/
                $result = $polaczenie->query("SELECT id FROM uzytkownicy WHERE nr_telefonu='$nr_tel'");

                /*wyrzucenie błędu gdy połączenie z bazą danych się nie uda, wyrzucanie wyjątku*/
                if(!$result) throw new Exception($polaczenie->error);

                /*sprawdzenie liczby wierszy: number of rows -> num_rows*/
                $ile_takich_nr = $result->num_rows;
                if($ile_takich_nr>0)
                {
                    $wszystko_ok = false;
                    $_SESSION['blad_numer']="Istnieje już konto zarejestrowane na podany numer telefonu";
                }
            	 if($wszystko_ok == true){
                    header('Location: mail.php');
                    /*wszystkie wymagania przeszły poprawnie i dodanie użytkownika do bazy*/
                    if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$imie', '$nazwisko', '$login', '$email', '$nr_tel', '$hashowane_haslo')"))
                    {
                        $_SESSION['Rejestracja przebiegła prawidłowo'] = true;
 
                        header('Location: witaj.php');
                    }
                    else
                    {
                        throw new Exception($polaczenie->error);
                    }
                }

                $polaczenie->close();
            }
        }
        /*wyłapywanie wyjątków czyli błędów*/
        catch(Exception $blad)
        {
            echo '<span style="color: red;">Błąd serwera. Spróbój ponownie później</span>';
            /*odkomentować w razie potrzeby namierzenia problemu echo*/ echo '<br>Informacja o błedzie dla dewelopera'.$blad;
        } 

    }

?>

<!DOCTYPE html>
<html lang="p-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarejestruj się - TechTornado.pl</title>
    <link rel="stylesheet" href="css_rejestracja.css"/>
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
<div class="tresc">
<div class="div_rej">     
    <form method="post" class="pola_rejestracji">
        <p><h3>Formularz zakładania konta w TechTornado.pl</h3></p>
        Imię: <br> <input type="text" placeholder="(wymagane)" 
        value="<?php 
        if (isset($_SESSION['zapamietaj_imie'])) 
        {
            echo $_SESSION['zapamietaj_imie'];
            unset($_SESSION['zapamietaj_imie']);
        } 
        ?>" name="imie"/><br><br>

        Nazwisko: <br> <input type="text" placeholder="(wymagane)" value="<?php 
        if (isset($_SESSION['zapamietaj_nazwisko'])) 
        {
            echo $_SESSION['zapamietaj_nazwisko'];
            unset($_SESSION['zapamietaj_nazwisko']);
        } 
        ?>" name="nazwisko"/><br><br>

        Login: <br> <input type="text" placeholder="(wymagane)" value="<?php 
        if (isset($_SESSION['zapamietaj_login'])) 
        {
            echo $_SESSION['zapamietaj_login'];
            unset($_SESSION['zapamietaj_login']);
        } 
        ?>" name="login"/><br><br>
        <?php
            if(isset($_SESSION['blad_login']))
            {
                echo '<div class="error">'.$_SESSION['blad_login'].'</div>';
                unset($_SESSION['blad_login']);
            }
        ?>

        E-mail: <br> <input type="text" placeholder="(wymagane)" value="<?php 
        if (isset($_SESSION['zapamietaj_email'])) 
        {
            echo $_SESSION['zapamietaj_email'];
            unset($_SESSION['zapamietaj_email']);
        } 
        ?>" name="mail"/><br><br>
        <?php
            if(isset($_SESSION['blad_mail']))
            {
                echo '<div class="error">'.$_SESSION['blad_mail'].'</div>';
                unset($_SESSION['blad_mail']);
            }
        ?>

        Numer telefonu: <br> <input type="varchar" placeholder="(wymagane)"
        value="<?php 
        if (isset($_SESSION['zapamietaj_tel'])) 
        {
            echo $_SESSION['zapamietaj_tel'];
            unset($_SESSION['zapamietaj_tel']);
        } 
        ?>" name="nr_tel"/><br><br>
        <?php
            if(isset($_SESSION['blad_numer']))
            {
                echo '<div class="error">'.$_SESSION['blad_numer'].'</div>';
                unset($_SESSION['blad_numer']);
            }
        ?>

        Hasło: <br> <input type="password" placeholder="(wymagane)" name="haslo"/><br><br>
        <?php
            if(isset($_SESSION['blad_haslo']))
            {
                echo '<div class="error">'.$_SESSION['blad_haslo'].'</div>';
                unset($_SESSION['blad_haslo']);
            }
        ?>
        <?php
            if(isset($_SESSION['blad_powtorz_haslo']))
            {
                echo '<div class="error">'.$_SESSION['blad_powtorz_haslo'].'</div>';
                unset($_SESSION['blad_powtorz_haslo']);
            }
        ?>
        
        Powtórz hasło: <br> <input type="password" placeholder="(wymagane)" name="powtorz_haslo"/><br><br>
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
        </label><br><br>
        <?php
            if(isset($_SESSION['blad_rodo']))
            {
                echo '<div class="error">'.$_SESSION['blad_rodo'].'</div>';
                unset($_SESSION['blad_rodo']);
            }
        ?>

        <div class="g-recaptcha" data-sitekey="6Lcz_gIpAAAAAIKE1cc1Js0_F3VHWsRVDd_ws4MA"></div>
        <?php
            if(isset($_SESSION['blad_recaptcha']))
            {
                echo '<div class="error">'.$_SESSION['blad_recaptcha'].'</div>';
                unset($_SESSION['blad_recaptcha']);
            }
        ?>

        <br/>
        <input type="submit" value="Zarejestruj" class="zarejestruj"/>   
    </form><br>
</div>
    <div class="zalety">
        <p><h1>Dlaczego warto założyć konto w TechTornado ?</h1></p>
        <p class="p_tresc">1. Szybsze Zakupy

        Kiedy masz konto w TechTornado.pl, Twoje dane kontaktowe i adres dostawy są zapisane, co oznacza, że nie musisz ich wprowadzać za każdym razem, gdy robisz zakupy. To sprawia, że proces zakupowy jest szybszy i bardziej wygodny.<br><br>

        2. Śledzenie Zamówień<br><br>

        Założenie konta pozwala Ci na bieżące śledzenie statusu swoich zamówień. Dowiesz się, kiedy Twoje zamówienie zostało zrealizowane i kiedy możesz spodziewać się dostawy.<br><br>

        3. Historia Zakupów<br><br>

        Konto umożliwia przechowywanie historii Twoich zakupów. Możesz łatwo sprawdzić, co wcześniej kupiłeś i ponownie zamówić ulubione produkty.</p><br>
        <img src="logo_TT.pl.png" class="img_zalety"><br>
    <a href="index.php">
        <button class="zaloguj">Zaloguj się</button>
    </a>
    </div>
</div><br>
<div class="stopka">
    Copyright © 2023 Sklep Internetowy TechTornado.pl
</div>
</body>
</html>