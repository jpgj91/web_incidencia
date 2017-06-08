<?php
/*Clases necesarias*/
require_once 'class/F_validar.php';
require_once 'class/Usuario.php';
/*End class*/
    /* vistas necesearias*/
    $vista_Login= 'view/home.php';
    $vista_header= 'view/header.php';
    $vista_footer= 'view/footer.php';
    /*End vistas*/
@session_start();
/*logica para logearse y que funcione todo ok*/
if(isset($_POST['Logearse'])){ // si pulsamos el boton logearse mirar que los campos sean correctos
        $email      = (isset($_POST['email'])) ? $_POST['email'] : null;
        $password   = (isset($_POST['pass'])) ? $_POST['pass']  : null;


    $valido = new Validar;


if($valido->validarLogin($email,$password)){ // si campos mail y pasword son correctos

    $pass=md5($password); // guardamos la pass y la encryptamos para ver si coincide con la que tenemos en la base de datos
    $conn = new mysqli('localhost', 'root', '','incidencias');
    $sql = "SELECT * FROM `usuario` WHERE `email`='$email'"; 
    $resultado=$conn->query($sql);
    $fila=$resultado->fetch_array();
  
    if($fila[2]==$pass){ // comparamos la pass obtenida de nuestra base de datos con la introducida por el usuario para ver si coinciden si no daremos un error 

        /*instanciamos a la clase usuario para guardad lo obtenido por la query una vez que los campos sean correctos y coincidan con los de BD*/
        $loged = new Usuario();
        $loged->setid($fila[0]);
        $loged->setname($fila[1]);
        $loged->setpass($fila[3]);
        $loged->setmail($fila[2]);
        $loged->setrol($fila[4]);
        $_SESSION["usu_reg"][]=$loged->getid();
        $_SESSION["usu_reg"][]=$loged->getname();
        $_SESSION["usu_reg"][]=$loged->getpass();
        $_SESSION["usu_reg"][]=$loged->getmail();
        $_SESSION["usu_reg"][]=$loged->getrol();
        if (! empty($_SESSION["usu_reg"])){
             if($_SESSION["usu_reg"][4]==1){header("Location: incidencias_cliente.php");}
             if($_SESSION["usu_reg"][4]==2){header("Location: incidencias_jefeproyecto.php");}
             if($_SESSION["usu_reg"][4]==3){header("Location: incidencias_programador.php");}
        }
        }else{

        if(!empty($emailerror)){

        }else{
        $usuarioerr="El mail o contraseña no existe";



        }
    }
    $conn->close();
}else{


    $Usuerror  = isset($valido->error_user)  ? $valido->error_user  : null;
    $passerr    = isset($valido->error_clave) ? $valido->error_clave : null ;

}

}
/*Llamamos a las vistas necesarias para cargar nuestra pagina*/
require_once $vista_header;
require_once $vista_Login;
require_once $vista_footer;
