<div id="wrap_form_Cerrar">
        <form action="" method="post">
            <h3>Cerrar Incidencia</h3>
            <table>
                <tr>
                    <td><strong> Nombre</strong></td>
                    <td><?php echo "<span><i>$nom</i></span>";?></td>
                    <?php echo "<input type='hidden' name='id_usu' value='$id' readonly>" ;?>
                </tr>
                <tr>
                    <td><strong>Asunto</strong></strong></strong></td>
                    <td>
                    <textarea name="descripccion" rows="3" cols="60" readonly><?php echo $asunto;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td><strong>Email</strong></strong></td>
                    <td><?php echo "<span><i>$mail</i></span>" ;?></td>
                </tr>
                <tr>
                    <td><strong>Prioridad</strong></td>
                    <td>
                        <?php echo $prioridad;?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Estado</strong></td>
                    <td>
                        <?php echo $estado;?>
                    </td>
                </tr>
                <td><strong>Tipo error</strong></td>
                    <td>
                        <?php echo $tipo_err;?>
                    </td>
                <tr>
                    <td><strong>Descripcion</strong></td>
                    <td>
                        <textarea placeholder="max 140 caracteres" rows="4" cols="60" readonly><?php echo $descripccion;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td><strong>Nota interna</strong></td>
                    <td>
                        <textarea name="comentario" placeholder="max 140 caracteres" rows="4" cols="60"></textarea>
                    </td>
                </tr>
                
            </table>
            <input type="submit" name="Cerrar_incidencia" value="Cerrar Incidencia" id="button_cerrar">
        </div>
    </form>