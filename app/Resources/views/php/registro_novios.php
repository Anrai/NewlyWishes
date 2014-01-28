<?php require("header.php") ?>

  </head>

<?php require("top.php") ?>


<?php

include("db/conexion.php"); 

$bd_servidor = $dbhost;
$bd_usuario = $dbusuario;
$bd_contrasenya = $dbpassword;
$bd_bdname = $db;

$bd_tabla_estados = "estados";
$bd_tabla_paises = "paises"; 

$link = mysql_connect($bd_servidor,$bd_usuario,$bd_contrasenya);
mysql_select_db($bd_bdname,$link);
mysql_query("SET NAMES 'utf8'");
?>


<div class="container" style="margin-top:0px; margin-bottom:0px; padding-left:50px; padding-right:50px; background-color:rgba(255,255,255,1);">

      <div class="row">
        <div class="col-md-10">
        <h1><img src="img/registro.jpg" alt="Registro" width="210"></h1><br />
Si son una pareja que quiere simplificar la planeación de su boda, por favor regístrense.
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
        <input type="text" name="m_nombre" placeholder="Nombre" id="input_registro_novios"/>
        <input type="text" name="m_snombre" placeholder="Segundo Nombre" id="input_registro_novios"/>
        <input type="text" name="m_apellido_paterno" placeholder="Apellido Paterno" id="input_registro_novios"/>
        <input type="text" name="m_apellido_materno" placeholder="Apellido Materno" id="input_registro_novios"/>
        </div>
        <div class="col-md-4">
        <input type="text" name="m_email" placeholder="E-Mail" id="input_registro_novios"/>
		<input type="text" name="m_lada" maxlength="3" placeholder="LADA" id="input_registro_novios" style="width:20%;"/>
		<input type="text" name="m_telefono_personal" maxlength="8" placeholder="Teléfono de casa u oficina" id="input_registro_novios" style="width:74%;"/>
		<input type="text" name="m_celular" maxlength="10" placeholder="Teléfono celular" id="input_registro_novios"/>
        </div>
        <div class="col-md-4">
        <input type="text" name="m_direccion" placeholder="Dirección completa" id="input_registro_novios"/>
		País:&nbsp;
        <select name="m_pais" id="input_registro_novios" style="width:70%;">
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
        
        <option value="<?php echo($estado_id) ?>"><?php echo($estado)?></option>
        
        <?php
        }
        mysql_free_result($result_e);
        ?>
        </select>
        <input type="text" name="m_ciudad" placeholder="Municipio o Delegación" id="input_registro_novios"/>
        <input type="text" name="m_cp" maxlength="5" placeholder="Código postal" id="input_registro_novios"/>
        </div>
      </div>

<div class="row" style="margin-top:20px;">
        <div class="col-md-12">
      <h3>Datos del Novio:</h3>
      </div>
      </div>  
      <div class="row">
        <div class="col-md-4">
        
        <input type="text" name="h_nombre" placeholder="Nombre" id="input_registro_novios"/>
<input type="text" name="h_snombre" placeholder="Segundo Nombre" id="input_registro_novios"/>
<input type="text" name="h_apellido_paterno" placeholder="Apellido Paterno" id="input_registro_novios"/>
<input type="text" name="h_apellido_materno" placeholder="Apellido Materno" id="input_registro_novios"/>
        
        </div>
        <div class="col-md-4">
        
        <input type="text" name="h_email" placeholder="E-Mail" id="input_registro_novios"/>
<input type="text" name="h_lada" maxlength="3" placeholder="LADA" id="input_registro_novios" style="width:20%;"/>
<input type="text" name="h_telefono_personal" maxlength="8" placeholder="Teléfono de casa u oficina" id="input_registro_novios" style="width:74%;"/>
<input type="text" name="h_celular" maxlength="10" placeholder="Teléfono celular" id="input_registro_novios"/>
        
        </div>
        <div class="col-md-4">
        <input type="text" name="h_direccion" placeholder="Dirección completa" id="input_registro_novios"/>
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

<option value="<?php echo($pais_id) ?>" selected><?php echo($pais)?></option>

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

<option value="<?php echo($estado_id) ?>"><?php echo($estado)?></option>

<?php
}
mysql_free_result($result_e);
?>
</select>
<input type="text" name="h_ciudad" placeholder="Municipio o Delegación" id="input_registro_novios"/>
<input type="text" name="h_cp" placeholder="Código postal" id="input_registro_novios"/>
        </div>
        </div>

	<div class="row" style="margin-top:20px;">
        <div class="col-md-10">
        <h3>Datos de Usuario:</h3>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-4">
        <input type="text" name="usuario" placeholder="Usuario" id="input_registro_novios"/>
		<input type="password" name="password" placeholder="Contraseña" id="input_registro_novios"/>
        </div>
        <div class="col-md-4">
        <input type="text" name="preguntas" placeholder="Pregunta Secreta" id="input_registro_novios"/>
		<input type="text" name="respuestas" placeholder="Respuesta Secreta" id="input_registro_novios"/>
        </div>
        <div class="col-md-4">
        <input type="checkbox" name="terminos1" value="1">&nbsp;&nbsp;He leido y acepto los términos y condiciones<br>
		<input type="checkbox" name="terminos2" value="1">&nbsp;&nbsp;He leido y acepto los términos de privacidad<br>
		<input type="submit" value="enviar" id="enviar_form" style="margin-top:10px;"/>
        </div>
      </div>

</div><!-- CONTAINER -->

	



</div>

</form>
</div>

<?php require("footer.php") ?>