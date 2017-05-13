<?php
	@session_start();
    session_destroy();
    unset($_SESSION["usu_reg"]);
    header("Location: home.php");
    ?>