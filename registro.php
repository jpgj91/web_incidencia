<?php
/*Class*/
include_once 'class/F_validar.php';
require_once 'class/Usuario.php';
/*End class*/
/*Viewe*/
$vista_form = 'view/Registrarse.php';
$vista_header= 'view/header.php';
$vista_footer= 'view/footer.php';
/*End View*/

if(isset($_POST['visto']) && $_POST['visto'] == 'yes'){ //miramos  que el check esta en valor yes y clickado sino no podremos registranos

    $user       = (isset($_POST['user'])) ? $_POST['user']   : null; //si usuario no esta definido lo ponemos a null, sino toma el valor de $_post
    $email      = (isset($_POST['mail'])) ? $_POST['mail'] : null;
    $password   = (isset($_POST['pass'])) ? $_POST['pass']  : null;
    $confirm_pw = (isset($_POST['pass2'])) ? $_POST['pass2'] : null;
    $rol       = 1;  // el rol siempre sara 1 puesto que es su defecto el usuario que se registre nuevo sera cliente
    $valido = new Validar; // creamos instancia de la clase validar
    $login  = new Usuario; // creamos instancia de la clase usuario
    if($valido->validacion($user,$password,$confirm_pw,$email)) { // llamamos a la funcion validacion y  le pasamos los parametros necesarios para validarlos
        $conn = new mysqli('localhost', 'root', '','incidencias');
        $pass=md5($password);
        $sql = "SELECT * FROM `usuario` WHERE `email`='$email'"; // sql para comprobar si existe email
        if($conn->query($sql)){ //si estos datos son validos y la query  es correcta
            if($conn->affected_rows == 0) { // si esa query tiene 0 filas afectadas quiere decir que el email no existe procedemos a insertar el nuevo usuario
                $sql = 'INSERT INTO `usuario` (name,password,email,rol_id)
                     VALUES ("'.$user.'","'.$pass.'","'.$email.'","'.$rol.'")';

                if ($conn->query($sql) === TRUE) {

                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
                header("Location: home.php");
            }else { // si email existe le damos error y recargamos la pagina actual
                $emailErr = 'Email ya existe.';
                $vista_form = 'Registrarse.php';
            }

        }else{

          header('500 Internal Server Error', true, 500);
          die;
        }   

    } else { // si alguno de estos parametros no son correctos saltaremos los diferentes errores que encontramos en la classe validar
        $passerr      = isset($valido->error_clave) ? $valido->error_clave : null;
        $passerrep    = isset($valido->error_clave_con) ? $valido->error_clave_con : null;
        $usuvacio     = isset($valido->error_user)  ? $valido->error_user  : null;
        $emailErr     = isset($valido->error_mail)  ? $valido->error_mail  : null;

            
    }



}else{
    $errorcheck="Falta aceptar las condiciones";
}
require_once $vista_header;
require_once $vista_form;
require_once $vista_footer;
