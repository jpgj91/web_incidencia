<?php

session_start();
$usu=$_SESSION['usu_reg'][0];
require_once 'class/incidencia.php';
$vista = 'view/home_cliente.php';
$vista_header= 'view/header.php';
$vista_footer= 'view/footer.php';

/*codigo para que no entren en esta pagina si no eres el usuario indicado*/
	if(isset($_SESSION['usu_reg'])){
        if ($_SESSION['usu_reg'][4]==1) {}
            else{
                if ($_SESSION['usu_reg'][4]==2) {header("Location:incidencias_jefeproyecto.php");}
                 if ($_SESSION['usu_reg'][4]==3) {header("Location:incidencias_programador.php");}
            }
            }
        else{
        header("Location:home.php");
    }


if (isset($_POST['Crear_incidencia'])) {
	if (!empty($_POST['asunto'])) {
		if (!empty($_POST['prioridad'])) {
			if ($_POST['t_err']!="seleccione") {
				# code...
			
			$asunto   = $_POST['asunto'];
			$priority = $_POST['prioridad'];
			$mensaje  = $_POST['descripccion'];
			$error_tipo = $_POST['t_err'];
			$user=$_SESSION['usu_reg'][0];
			$estado  = 1;
			$null = "";
			$fecha_actual = date('Y-m-d'); 
			$conn = new mysqli('localhost', 'root', '','incidencias');
			$sql = 'INSERT INTO `incidencia` (`descripcion`, `asunto`, `prioridad_id`, `estado_id`,`reportador_usuario_id`, `error_id`,`fecha`)
                 VALUES ("'.$mensaje.'","'.$asunto.'","'.$priority.'","'.$estado.'","'.$user.'","'.$error_tipo.'","'.$fecha_actual.'")';
                
                 if ($conn->query($sql) === TRUE) {
                 	if (!empty($_POST['comentario'])) {
						$coment =$_POST['comentario'];
						$conn = new mysqli('localhost', 'root', '','incidencias');
						$sql1 = "SELECT * FROM `incidencia` join`estado` ON `incidencia`.`estado_id`=`estado`.`id` where `asunto` ='$asunto'";
						$resultado=$conn->query($sql1);
						$fila=$resultado->fetch_array();
						$inc =new incidencia();
						$inc->setid($fila[0]);
						$id_usu=$inc->getid();
						$sql = 'INSERT INTO `comentario`(`texto`, `visibilidad_id`, `incidencia_id`, `usuario_id`) VALUES ("'.$coment.'","1","'.$id_usu.'","'.$usu.'")';
						$conn->query($sql);
						header('Location: incidencias_cliente.php');
					}else{
						header('Location: incidencias_cliente.php');
					}
                 	
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            $conn->close();
           }else{
           		$err_tipo= "debe seleccionar un error";
           }
             
		}else{
			$err_prioridad= "radio buton vacio";
		}
           
	}else{
		$err_asunto= "Asunto no puede estar vacio";
	}
	
}else{
	
}

require_once $vista_header;
require_once $vista;
require_once $vista_footer;