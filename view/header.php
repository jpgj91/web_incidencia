<!DOCTYPE html>
<?php header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');
 
// Esto le dice a PHP que generaremos cadenas UTF-8
mb_http_output('UTF-8');
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Jp engine</title>
       <link rel="stylesheet" type="text/css" href="style.css">
       <link rel="shortcut icon" type="image/ico" href="img/favicon.ico"/>

    </head>
    <body>
  
        <header id="head">
            <section id="logo">
                
            </section>
            <section class="usuario">
                <p id="bienvenida"> <?php  if(empty($_SESSION["usu_reg"])){}else{ echo "Usuario: "."<b>".$_SESSION["usu_reg"][1]."</b>"; }  ?></p>
            </section>
            <section class="fecha">
                <p id="fecha"><?php  setlocale(LC_TIME, 'spanish'); echo strftime('%A, %d  %B ');?></p>
            </section>
            
           
            </section>
        </header>
        <nav>
            <ul>
            
                <?php if(empty($_SESSION["usu_reg"])){}else{ if($_SESSION["usu_reg"][4]==1){echo "<li><a  href='incidencias_cliente.php'>Incidencias</a></li>";} }?>
                <?php if(empty($_SESSION["usu_reg"])){}else{ if($_SESSION["usu_reg"][4]==1){echo "<li><a  href='CrearIncidencia.php'>Crear Incidencia</a></li>";} }?>
                <?php if(empty($_SESSION["usu_reg"])){}else{ if($_SESSION["usu_reg"][4]==1){echo "<li><a  href='Revision.php'>Revision</a></li>";} }?>
                <?php if(empty($_SESSION["usu_reg"])){}else{ if($_SESSION["usu_reg"][4]==1){echo "<li><a  href='cerrar_incidencias.php'>Cerrar Incidencia</a></li>";} }?>
                <?php if(empty($_SESSION["usu_reg"])){}else{ if($_SESSION["usu_reg"][4]==2){echo "<li><a  href='incidencias_jefeproyecto.php'>Incidencias</a></li>";} }?>
                <?php if(empty($_SESSION["usu_reg"])){}else{ if($_SESSION["usu_reg"][4]==2){echo "<li><a  href='assignar_incidencia.php'>Asignar</a></li>";} }?>
                <?php if(empty($_SESSION["usu_reg"])){}else{ if($_SESSION["usu_reg"][4]==2){echo "<li><a  href='revisar_incidencias_jefeproyecto.php'>Revisar Incidencias</a></li>";} }?>
                <?php if(empty($_SESSION["usu_reg"])){}else{ if($_SESSION["usu_reg"][4]==3){echo "<li><a  href='incidencias_programador.php'>Incidencias</a></li>";} }?>
                <?php if(empty($_SESSION["usu_reg"])){}else{ if($_SESSION["usu_reg"][4]==3){echo "<li><a  href='revisar_incidencias_programador.php'>Revisar Incidencias</a></li>";} }?>
                <?php if(empty($_SESSION["usu_reg"])){}else{ echo "<li class='active' style=' float: right;'><a href='logout.php'>cerrarsesion</a></li>"; }?>
                
            </ul>

        </nav>
          </body>
          </html>
          <?php 
          