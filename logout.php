<?php
	@session_start();// destruimos la session una vez el usuario de a cerrar sesion ademas de destruir la cookie para  la politicas  y le redirecciono a home.
    session_destroy();
    unset($_SESSION["usu_reg"]);
    setCookie('tiendaaviso','0',-365);
    header("Location: home.php");
    ?>