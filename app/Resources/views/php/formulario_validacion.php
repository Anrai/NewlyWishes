
    <div class="row">
        <div class="col-md-10">
        <h1><img src="img/registro.jpg" alt="Registro" width="210"></h1><br />
        </div>
      </div>
     
      <div class="row" style="margin-top:20px;">
        <div class="col-md-8">
     	<form action="validar_registro_novios.php" method="post">
		<h3>Datos de la Novia:</h3>
		</div>
      </div>
      
		<div class="row">
        <div class="col-md-4">
<input type="text" name="m_nombre" placeholder="Nombre" value="<?php echo($m_nombre) ?>" id="input_registro_novios"/>
<input type="text" name="m_snombre" placeholder="Segundo Nombre" value="<?php echo($m_snombre) ?>"  id="input_registro_novios"/>
<input type="text" name="m_apellido_paterno" placeholder="Apellido Paterno" value="<?php echo($m_apellido_paterno) ?>" id="input_registro_novios"/>
<input type="text" name="m_apellido_materno" placeholder="Apellido Materno" value="<?php echo($m_apellido_materno) ?>" id="input_registro_novios"/>
</div>

<div class="col-md-4">
<input type="text" name="m_email" placeholder="E-Mail" value="<?php echo($m_email) ?>" id="input_registro_novios"/>
<input type="text" name="m_lada" maxlength="3" placeholder="LADA" value="<?php echo($m_lada) ?>" id="input_registro_novios" style="width:20%;"/>
<input type="text" name="m_telefono_personal" maxlength="8" placeholder="Teléfono de casa u oficina" value="<?php echo($m_telefono_personal) ?>" id="input_registro_novios" style="width:74%;"/>
<input type="text" name="m_celular" maxlength="10" placeholder="Celular" value="<?php echo($m_celular) ?>" id="input_registro_novios"/>
</div>

<div class="col-md-4">
<input type="text" name="m_direccion" placeholder="Dirección" value="<?php echo($m_direccion) ?>" id="input_registro_novios"/>
País:&nbsp;
<select name="m_pais" id="input_registro_novios" style="width:70%;">
<?php
$result = mysql_query("SHOW FIELDS from `$bd_tabla_paises`",$link);
while($row = mysql_fetch_row($result)) { }
$query = "select * from $bd_tabla_paises";

$result = mysql_query($query,$link);
$found = false; 
while ($row = mysql_fetch_array($result)) {
$found = true;

if(is_int($nombre_campo)) {
continue;
}
$pais_id = $row['ID'];
$pais = $row['pais'];

?>

<option value="<?php echo($pais_id) ?>" selected><?php echo($pais)?></option>

<?php
}
mysql_free_result($result);
?>
</select><br />
Estado:
<select name="m_estado" id="input_registro_novios" style="width:70%;">
<?php
$result_e = mysql_query("SHOW FIELDS from `$bd_tabla_estados`",$link);
while($row = mysql_fetch_row($result_e)) { }
$query = "select * from $bd_tabla_estados ORDER BY `id` ASC";

$result_e = mysql_query($query,$link);
$found = false; 
while ($row = mysql_fetch_array($result_e)) {
$found = true;

if(is_int($nombre_campo)) {
continue;
}

$estado_id = $row['ID'];
$estado = $row['estado'];

?>

<option value="<?php echo($m_estado) ?>"><?php echo($estado)?></option>

<?php
}
mysql_free_result($result_e);
?>
</select>
<input type="text" name="m_ciudad" placeholder="Municipio o Delegación" value="<?php echo($m_ciudad) ?>" id="input_registro_novios"/>
<input type="text" name="m_cp" placeholder="Código Postal" maxlength="5" value="<?php echo($m_cp) ?>" id="input_registro_novios"/>
</div>
</div>

<!-- DATOS DEL NOVIO -->
<div class="row" style="margin-top:20px;">
        <div class="col-md-12">
      <h3>Datos del Novio:</h3>
      </div>
      </div>  
      <div class="row">
        <div class="col-md-4">
<input type="text" name="h_nombre" placeholder="Nombre" value="<?php echo($h_nombre) ?>" id="input_registro_novios"/>
<input type="text" name="h_snombre" placeholder="Segundo Nombre" value="<?php echo($h_snombre) ?>" id="input_registro_novios"/>
<input type="text" name="h_apellido_paterno" placeholder="Apellido Paterno" value="<?php echo($h_apellido_paterno) ?>" id="input_registro_novios"/>
<input type="text" name="h_apellido_materno" placeholder="Apellido Materno" value="<?php echo($h_apellido_materno) ?>" id="input_registro_novios"/>
</div>

<div class="col-md-4">
<input type="text" name="h_email" placeholder="E-Mail" value="<?php echo($h_email) ?>" id="input_registro_novios"/>
<input type="text" name="h_lada" placeholder="LADA" maxlength="3" value="<?php echo($h_lada) ?>" id="input_registro_novios" style="width:20%;"/>
<input type="text" name="h_telefono_personal" placeholder="Teléfono de casa u oficina" maxlength="8" value="<?php echo($h_telefono_personal) ?>" id="input_registro_novios" style="width:74%;"/>
<input type="text" name="h_celular" placeholder="Celular" maxlength="10" value="<?php echo($h_celular) ?>" id="input_registro_novios"/>
</div>

<div class="col-md-4">
<input type="text" name="h_direccion" placeholder="Dirección" value="<?php echo($h_direccion) ?>" id="input_registro_novios"/>
País:&nbsp;
<select name="h_pais" id="input_registro_novios" style="width:70%;">
<?php
$result = mysql_query("SHOW FIELDS from `$bd_tabla_paises`",$link);
while($row = mysql_fetch_row($result)) { }
$query = "select * from $bd_tabla_paises ORDER BY `id` ASC";

$result = mysql_query($query,$link);
$found = false; 
while ($row = mysql_fetch_array($result)) {
$found = true;

if(is_int($nombre_campo)) {
continue;
}
$pais_id = $row['ID'];
$pais = $row['pais'];

?>

<option value="<?php echo($h_pais) ?>" selected><?php echo($pais)?></option>

<?php
}
mysql_free_result($result);
?>
</select><br />
Estado:
<select name="h_estado" id="input_registro_novios" style="width:70%;">
<?php
$result_e = mysql_query("SHOW FIELDS from `$bd_tabla_estados`",$link);
while($row = mysql_fetch_row($result_e)) { }
$query = "select * from $bd_tabla_estados ORDER BY `id` ASC";

$result_e = mysql_query($query,$link);
$found = false; 
while ($row = mysql_fetch_array($result_e)) {
$found = true;

if(is_int($nombre_campo)) {
continue;
}

$estado_id = $row['ID'];
$estado = $row['estado'];

?>

<option value="<?php echo($h_estado) ?>"><?php echo($estado)?></option>

<?php
}
mysql_free_result($result_e);
?>
</select>
<input type="text" name="h_ciudad" placeholder="Ciudad" value="<?php echo($h_ciudad) ?>" id="input_registro_novios"/>
<input type="text" name="h_cp" maxlength="5" placeholder="Código Postal" value="<?php echo($h_cp) ?>" id="input_registro_novios"/>
</div>
</div>

<!-- DATOS DEL NOVIO -->
<div class="row" style="margin-top:20px;">
        <div class="col-md-10">
        <h3>Datos de Usuario:</h3>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-4">
<input type="text" name="usuario" placeholder="Usuario" value="<?php echo($usuario) ?>" id="input_registro_novios"/>
<input type="password" name="password" placeholder="Contraseña" id="input_registro_novios"/>
</div>

<div class="col-md-4">
<input type="text" name="preguntas" placeholder="Pregunta Secreta" value="<?php echo($preguntas) ?>" id="input_registro_novios"/>
<input type="text" name="respuestas" placeholder="Respuesta Secreta" value="<?php echo($respuestas) ?>" id="input_registro_novios"/>
</div>

<div class="col-md-4">
<input type="checkbox" name="terminos1" value="1">&nbsp;&nbsp;He leido y acepto los términos y condiciones<br>
<input type="checkbox" name="terminos2" value="1">&nbsp;&nbsp;He leido y acepto los términos de privacidad<br>
<input type="submit" value="enviar" id="enviar_form" style="margin-top:10px;"/>
</div>
</form>