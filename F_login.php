<?php
require_once 'F_validar.php';
require_once 'Usuario.php';
session_start();
setcookie('visita',0,time()+3600);
    $vista_Login= 'home.php';


if(isset($_POST['f_registro'])){
    header("Location: F_registro.php");
}else{
if(isset($_POST['Logearse'])){
        $email      = (isset($_POST['email'])) ? $_POST['email'] : null;
        $password   = (isset($_POST['pass'])) ? $_POST['pass']  : null;


    $valido = new Validar;


if($valido->validarLogin($email,$password)){

    $pass=md5($password);
    $conn = new mysqli('localhost', 'root', '','incidencias');
    $sql = "SELECT * FROM `usuario` WHERE `email`='$email'";
    $resultado=$conn->query($sql);
    $fila=$resultado->fetch_array();
  
    if($fila[1]==$pass){

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
          
            $vista_Login = 'home_cliente.php';
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
}
 require_once $vista_Login;
