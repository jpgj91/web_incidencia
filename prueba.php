<html> 

<head> 
<title>Formulario con estilos CSS.</title> 

<style type="text/css">  

#formul { 
    padding: 20px 0px 0px 30px;   /* margen con valores: arriba - derecha - abajo - izquierda */
    font-family:verdana,arial;
    font-size:9pt;
} 

.campos { 
    font-family:verdana,arial;     /* tipo de letra */ 
    width: 500px;                 /* anchura de campos de formulario */ 
    font-size:8pt;                /* tamaño de la letra*/  
    color:#008000;                 /* color del texto */  
    border: 1px dotted red;        /* color del borde puede ser solid ó dotted */  
    background-color:#FFFF00;    /* color del fondo */  
} 

.boton{
    font-size:12px;
    font-family:Verdana,Helvetica;
    font-weight:bold;
    color:#0000FF;
    background:#A4C1FF;
    border:0px;
    width:120px;
    height:25px;
}

#b_reset { 
    margin: 0px 0px 0px 0px;    /* margen con valores: arriba - derecha - abajo - izquierda */ 
} 

#b_submit { 
    margin: -25px 0px 0px 380px;    /* margen con valores: arriba - derecha - abajo - izquierda */ 
} 

</style> 

</head> 

<body> 

<div id="formul">

    <h3>Formulario de contacto.</h3>

    <form method="POST" action="mensaje.php" name="mensaje_f" enctype="multipart/form-data"> 
     
        <p>Nombre: <br /> 
        <input class="campos" type="text" name="nombre"></p> 
        
        <p>E-Mail: <br /> 
        <input class="campos" type="text" name="email"></p> 
        
        <p>Asunto: <br /> 
        <input class="campos" type="text" name="asunto"></p> 
        
        <p>Mensaje:<br /> 
        <textarea class="campos" rows="10" name="mensaje"></textarea></p> 
        
        <p>Adjuntar archivo: <br />
        <input class="campos" type="file" name="archivo" size="20"></p>
        
        <input type="hidden" name="id" value=""> 

        <div id="b_reset"> 
        <input class="boton" type="reset" value="Restablecer" name="B2">
        </div>
        
        <div id="b_submit">
        <input class="boton" type="submit" value="Enviar mensaje" name="B1">
        </div>
             
    </form> 

</div>    
    
</body> 

</html> 