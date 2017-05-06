<?php
    unset($_SESSION["usu_reg"]);
    session_destroy();
    header("Location: home.php");

        
    ?>