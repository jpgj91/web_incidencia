
    <div id="wrap_registro">
        <section >
            <h2>Registrarse</h2>
            <p>Datos necesarios para llevar acabo el registro</p>
        </section>
        <form action="" method="post">
        <section>
        	<fieldset>
        	<legend>Datos Personales</legend>
        		<div>
            		<label>nombre</label><span class="obligado">*</span><input type="text" name="user">
            		<span class="error"> <?php echo (isset($usuvacio)) ? $usuvacio : '';?></span>
           		</div>
           		<div>
            		<label>email</label><span class="obligado">*</span><input type="text" name="mail">
            		<span class="error"><?php echo (isset($emailErr )) ? $emailErr  : '';?></span>
            	</div>
        	</fieldset>
        </section>
        <section>
        	<fieldset>
        	<legend>Contraseña</legend>
        		<div>
            		<label>password</label><span class="obligado">*</span><input type="password" name="pass">
            	<span class="error">Aqui: <?php echo (isset($passerr)) ? $passerr : '';?></span>
           		</div>
            	<div>
            		<label>Repita password</label><span class="obligado">*</span><input type="password" name="pass2">
           			 <span class="error">Aqui:<?php echo (isset($passerrep)) ? $passerrep : '';?></span>
           		 </div>
           	</fieldset>
        </section>
        <section>
        <input type="checkbox" name="visto" value="yes"><label> Acepta los <span class="importante">Terminos y Condiciones de Uso</span> de esta aplicacion web</label><br><span class="obligado">Aqui: <?php echo (isset($errorcheck)) ? $errorcheck : '';?></span><br>
        	<input class="btn" type="submit" value="sent">
        </section>
        </form>
    </div>
