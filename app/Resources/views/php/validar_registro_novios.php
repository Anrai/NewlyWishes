<?php require("header.php") ?>

  </head>

<?php require("top.php") ?>

<?php

include("db/conexion.php"); 

$bd_servidor = $dbhost;
$bd_usuario = $dbusuario;
$bd_contrasenya = $dbpassword;
$bd_bdname = $db;

$bd_tabla_usuario = "usuario";
$bd_tabla_novios = "novios"; 
$bd_tabla_estados = "estados";
$bd_tabla_paises = "paises"; 

$link = mysql_connect($bd_servidor,$bd_usuario,$bd_contrasenya);
mysql_select_db($bd_bdname,$link);
mysql_query("SET NAMES 'utf8'");

// Variables de Usuario
$usuario = mysql_real_escape_string($_POST['usuario']);
$password = mysql_real_escape_string($_POST['password']);
$tipo_usuario_ID = 1;	
$preguntas = mysql_real_escape_string($_POST['preguntas']);
$respuestas = mysql_real_escape_string($_POST['respuestas']);

// Variables de Novio
$h_nombre = mysql_real_escape_string($_POST['h_nombre']);
$h_snombre = mysql_real_escape_string($_POST['h_snombre']);
$h_apellido_paterno = mysql_real_escape_string($_POST['h_apellido_paterno']);
$h_apellido_materno = mysql_real_escape_string($_POST['h_apellido_materno']);
$h_email = mysql_real_escape_string($_POST['h_email']);
$h_lada = mysql_real_escape_string($_POST['h_lada']);
$h_telefono_personal = mysql_real_escape_string($_POST['h_telefono_personal']);
$h_celular = mysql_real_escape_string($_POST['h_celular']);
$h_direccion = mysql_real_escape_string($_POST['h_direccion']);
$h_pais = mysql_real_escape_string($_POST['h_pais']);
$h_estado = mysql_real_escape_string($_POST['h_estado']);
$h_ciudad = mysql_real_escape_string($_POST['h_ciudad']);
$h_cp = mysql_real_escape_string($_POST['h_cp']);

// Variables de Novia
$m_nombre = mysql_real_escape_string($_POST['m_nombre']);
$m_snombre = mysql_real_escape_string($_POST['m_snombre']);
$m_apellido_paterno = mysql_real_escape_string($_POST['m_apellido_paterno']);
$m_apellido_materno = mysql_real_escape_string($_POST['m_apellido_materno']);
$m_email = mysql_real_escape_string($_POST['m_email']);
$m_lada = mysql_real_escape_string($_POST['m_lada']);
$m_telefono_personal = mysql_real_escape_string($_POST['m_telefono_personal']);
$m_celular = mysql_real_escape_string($_POST['m_celular']);
$m_direccion = mysql_real_escape_string($_POST['m_direccion']);
$m_pais = mysql_real_escape_string($_POST['m_pais']);
$m_estado = mysql_real_escape_string($_POST['m_estado']);
$m_ciudad = mysql_real_escape_string($_POST['m_ciudad']);
$m_cp = mysql_real_escape_string($_POST['m_cp']);

if(empty($h_snombre)){
	$h_snombre=" ";	
}

if(empty($m_snombre)){
	$m_snombre=" ";	
}

?>

<div class="container" style="margin-top:0px; margin-bottom:0px; padding-left:50px; padding-right:50px; background-color:rgba(255,255,255,1);">


<?php

if(!$_POST['terminos1']=="1"){
	?>
    
    <p style="text-align:center; margin-top:10px;">
    Debes aceptar los términos y condiciones.
    </p>
    
    <?php
}	

if(!$_POST['terminos2']=="1"){
	?>
    
    <p style="text-align:center; margin-top:10px;">
    Debes aceptar los términos de privacidad.
    </p>
    
    <?php
	
}  
	
	

// Comprobar si no están vacíos los campos
foreach ($_POST as $key => $value)
 {
        if (empty($value))
        {
          // CAMPOS DE LA NOVIA
           if($key=="m_nombre"){ $campo_key="nombre de la novia"; }
           if($key=="m_apellido_paterno"){ $campo_key="apellido paterno de la novia"; }
           if($key=="m_apellido_materno"){ $campo_key="apellido materno de la novia"; }
           if($key=="m_email"){ $campo_key="e-mail de la novia"; }
           if($key=="m_lada"){ $campo_key="LADA de la novia"; }
           if($key=="m_telefono_personal"){ $campo_key="teléfono de casa u oficina de la novia"; }
           if($key=="m_celular"){ $campo_key="celular de la novia"; }
           if($key=="m_direccion"){ $campo_key="dirección de la novia"; }
           if($key=="m_ciudad"){ $campo_key="municipio o localidad de la novia"; }
           if($key=="m_cp"){ $campo_key="código postal de la novia"; }

           //CAMPOS DEL NOVIO
           if($key=="h_nombre"){ $campo_key="nombre del novio"; }
           if($key=="h_apellido_paterno"){ $campo_key="apellido paterno del novio"; }
           if($key=="h_apellido_materno"){ $campo_key="apellido materno del novio"; }
           if($key=="h_email"){ $campo_key="e-mail del novio"; }
           if($key=="h_lada"){ $campo_key="LADA del novio"; }
           if($key=="h_telefono_personal"){ $campo_key="teléfono de casa u oficina del novio"; }
           if($key=="h_celular"){ $campo_key="celular del novio"; }
           if($key=="h_direccion"){ $campo_key="dirección del novio"; }
           if($key=="h_ciudad"){ $campo_key="municipio o localidad del novio"; }
           if($key=="h_cp"){ $campo_key="código postal del novio"; }

           // CAMPOS DE USUARIO
           if($key=="usuario"){ $campo_key="usuario"; }
           if($key=="password"){ $campo_key="contraseña"; }
           if($key=="preguntas"){ $campo_key="pregunta secreta"; }
           if($key=="respuestas"){ $campo_key="respuesta secreta"; }

           
               ?>
              

               <p style="text-align:center; margin-top:10px;">El campo <strong>"<?php echo("$campo_key") ?>"</strong> esta vacío.</p>
               <?php
               break;
			   
        } 
		
 } 
 
 if(empty($value) || !isset($_POST['terminos1']) || !isset($_POST['terminos2'])){
	
	
	
	?>


<?php include("formulario_validacion.php") ?>
    
    <?php
	 
 }
 
if(!empty($_POST[$key]) && isset($_POST['terminos1']) && isset($_POST['terminos2'])) {
    
// comprobamos que el usuario ingresado no haya sido registrado antes 
     $sql_c = mysql_query("SELECT usuario FROM usuario WHERE usuario='".$usuario."'"); 
            if(mysql_num_rows($sql_c) > 0){ 
			?>
            
               <p style="text-align:center; margin-top:10px;">El nombre de usuario elegido <strong><em>"<?php echo($usuario) ?>"</em></strong> ya ha sido registrado anteriormente.</p>
              
               
               <?php include("formulario_validacion.php") ?>
               
                <?php
            } else { 
		
// Insertar Info en La tabla de Usuarios
$sql_insert = "INSERT INTO $bd_tabla_usuario (ID, usuario, password, tipo_usuario_ID, preguntas, respuestas, fecha_registro) VALUES ('','$usuario','$password','$tipo_usuario_ID','$preguntas','$respuestas',CURRENT_TIMESTAMP)";
mysql_query($sql_insert,$conexion);

// Sacar el id del usuario
$result_id = mysql_query("SHOW FIELDS from `$bd_tabla_usuarios`",$conexion);
while($row = mysql_fetch_row($result_id)) { }
$query = "SELECT ID FROM usuario WHERE usuario='".$usuario."'";

$result_id = mysql_query($query,$conexion);
$found = false; 
while ($row = mysql_fetch_array($result_id)) {
$found = true;

if(is_int($nombre_campo)) {
continue;
}

$usuario_ID = $row['ID'];

}
mysql_free_result($result_id);


// Insertar Info en La tabla de Usuarios
$sql_insert2 = "INSERT INTO $bd_tabla_novios (ID, usuario_ID, h_nombre, h_snombre, h_apellido_paterno, h_apellido_materno, h_email, h_lada, h_telefono_personal, h_celular, h_direccion, h_pais, h_estado, h_ciudad, h_cp, m_nombre, m_snombre, m_apellido_paterno, m_apellido_materno, m_email, m_lada, m_telefono_personal, m_celular, m_direccion, m_pais, m_estado, m_ciudad, m_cp, fecha_boda, ceremonia, ceremonia_direccion, recepcion, recepcion_direccion, padrino, madrina) VALUES ('','$usuario_ID','$h_nombre','$h_snombre','$h_apellido_paterno','$h_apellido_materno','$h_email','$h_lada','$h_telefono_personal','$h_celular','$h_direccion','$h_pais','$h_estado','$h_ciudad','$h_cp','$m_nombre','$m_snombre','$m_apellido_paterno','$m_apellido_materno','$m_email','$m_lada','$m_telefono_personal','$m_celular','$m_direccion','$m_pais','$m_estado','$m_ciudad','$m_cp','','','','','','','')";

mysql_query($sql_insert2,$conexion);

?>


<div style="margin:0 auto; width:270px;">
<img src="img/felicidades.jpg" width="269" height="74" />
<h2 style="text-align:center">¡Bienvenido a NewlyWishes <?php echo($usuario) ?>!.</h2>
<p style="text-align:center;"><a href="index.php">Regresar</a></p>
</div>

<?php  } } ?>

</div>
</div><!-- CONTAINER -->


<?php include("footer.php") ?>