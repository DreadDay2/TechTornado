<?php
    session_start();

    /*sprawdzenie ustawienia loginu i hasła, jeśli nie ma odesłanie do panelu logowania by nikt bez uprawnień nie podejrzał pliku konto.php bez zalogowania*/
    if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
    {
        header('Location: index.php');
        exit();
    }

    /*wymagany plik źródłowy require*/
    require_once "connect.php";
    
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    /*różne od 0 to znaczy, że jest błąd, gdy jest 0 to znaczy, że nie ma żadnego błędu; errno -> error number czyli kod błędu*/
    if($polaczenie->connect_errno!=0)
    {
        echo "Error:".$polaczenie->connect_errno;
    }
    else
    {
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        /*zabezpieczenie przed wstrzykiwaniem SQL*/
        /*zamienianie na encję niekórych (np. "", '') znaków by strona nie odczytywała tego jako polecenie*/
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        
        
        /*sprintf wprowadza porządek i poprawność typów danych przy wysyłanym zapytaniu*/
        /*wysłanie zapytania SQL na serwer z stringami i przefiltrowanie ich przez real escape string by ograniczać wszczykiwanie SQL*/
        if($result = @$polaczenie->query(sprintf("SELECT * FROM uzytkownicy WHERE login='%s'",
        mysqli_real_escape_string($polaczenie,$login))))
        {
            $number_user = $result->num_rows;
            if($number_user>0)
            {
                /*funkcja fetch_assoc wyciąga dane z bazy danych "aportuje je" i przypisuje do zmiennej $wiersz*/
                $wiersz = $result->fetch_assoc();
                /*weryfikacja hashowanego hasła, dobry login i dobre hasło (które jest zahashowane) -> zalogowanie na stronę*/ 
                if (password_verify($haslo, $wiersz['pass']))
                {
                    $_SESSION['zalogowany'] = true;

                    /*tworzenie sesji do poszczególnych danych (wyciągniętych po nazwie z bazy danych) wyświetlanych w konto.php*/
                    $_SESSION['id'] = $wiersz['id'];
                    $_SESSION['login'] = $wiersz['login'];
                    $_SESSION['email'] = $wiersz['email'];
                    $_SESSION['nr_telefonu'] = $wiersz['nr_telefonu'];
                	$_SESSION['user'] = $wiersz['user'];
                    $_SESSION['nazwisko'] = $wiersz['nazwisko'];

                    unset($_SESSION['blad']);
                    $result->close();
                    header('Location: konto.php');
                }
                /*dobry login ale złe hasło*/
                else
                {
                    $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                    header('Location: index.php'); 
                }
            }
            /*zły login i obojętnie jakie hasło*/
            else{

                $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                header('Location: index.php');
            }
        }
        $polaczenie->close();
    }

?>