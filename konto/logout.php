<?php
    /*otworzenie sesji*/ 
    session_start();
    
    session_unset();

    header('Location: index.php');
    
?>
