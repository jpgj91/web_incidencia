<?php

include_once 'F_validar.php';
require_once 'Usuario.php';
$vista_form = 'Registrarse.php';
$vista_header= 'header.php';
$vista_footer= 'footer.php';


if(isset($_POST['visto']) && $_POST['visto'] == 'yes'){

    $user       = (isset($_POST['user'])) ? $_POST['user']   : null; //si usuario no esta definido lo ponemos a null, sino toma el valor de $_post
    $email      = (isset($_POST['mail'])) ? $_POST['mail'] : null;
    $password   = (isset($_POST['pass'])) ? $_POST['pass']  : null;
    $confirm_pw = (isset($_POST['pass2'])) ? $_POST['pass2'] : null;
    $rol       = 1;
    $valido = new Validar;
    $login  = new Usuario;
    if($valido->validacion($user,$password,$confirm_pw,$email)) {
        $conn = new mysqli('localhost', 'root', '','incidencias');
        $pass=md5($password);
        $sql = "SELECT * FROM `usuario` WHERE `email`='$email'";
        if($conn->query($sql)){
            if($conn->affected_rows == 0) {
                $sql = 'INSERT INTO `usuario` (name,password,email,rol_id)
                     VALUES ("'.$user.'","'.$pass.'","'.$email.'","'.$rol.'")';

                if ($conn->query($sql) === TRUE) {

                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
                header("Location: home_cliente.php");
            }else {
                $emailErr = 'Email ya existe.';
                $vista_form = 'Registrarse.php';
            }

        }else{

          header('500 Internal Server Error', true, 500);
          die;
        }   

    } else {
        $passerr      = isset($valido->error_clave) ? $valido->error_clave : null;
        $passerrep    = isset($valido->error_clave_con) ? $valido->error_clave_con : null;
        $usuvacio     = isset($valido->error_user)  ? $valido->error_user  : null;
        $emailErr     = isset($valido->error_mail)  ? $valido->error_mail  : null;

            $vista_form = 'Registrarse.php';
    }



}else{
    $errorcheck="Falta aceptar las condiciones";
}
require_once $vista_header;
require_once $vista_form;
require_once $vista_footer;
