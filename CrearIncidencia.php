<?php

session_start();
require_once 'class/incidencia.php';
$vista = 'view/home_cliente.php';
$vista_header= 'view/header.php';
$vista_footer= 'view/footer.php';
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
                 	header('Location: incidencias_cliente.php');
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