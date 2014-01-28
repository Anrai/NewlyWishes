<?php require("header.php") ?>

  </head>

<?php require("top.php") ?>
<?php require("slider.php") ?>
    
    
    <div class="container" style="padding-top:30px; padding-bottom:10px; padding:30px;">
      <div class="row">
        <div class="col-sm-6 col-md-3" style="background-image:url('img/1.jpg');height:260px;background-repeat:no-repeat;background-position:center;"></div>
        <div class="col-sm-6 col-md-3" style="background-image:url('img/2.jpg');height:260px;background-repeat:no-repeat;background-position:center;"></div>
        <div class="col-sm-6 col-md-3" style="background-image:url('img/3.jpg');height:260px;background-repeat:no-repeat;background-position:center;"></div>
        <div class="col-sm-6 col-md-3" style="background-image:url('img/4.jpg');height:260px;background-repeat:no-repeat;background-position:center;"></div>
      </div>
      <div class="row">
      <img src="img/redes.jpg" />
      </div>
    </div>
  
    <div class="container" style="padding:30px; padding-top:0px;">
    
   <div class="row">
        <div class="col-md-7">
        	<h1>Enterate de ofertas, promociones y noticias en tu mail</h1>
          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<br> Aenean commodo ligula eget dolor. Aenean massa.<br> Cum sociis natoque penatibus et magnis dis parturient montes,<br> nascetur ridiculus mus.</p>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
        	<form class="form-horizontal">
            <fieldset>
            
            <!-- Form Name -->
            <legend></legend>
            
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for=""></label>
              <div class="controls">
                <input id="input_registro_novios" name="" type="text" placeholder="correo electrónico" class="input-xlarge" style="margin-bottom:0px; margin-top:-40px;" required>
                
              </div>
            </div>
            
            <!-- Select Basic -->
            <div class="control-group">
              <label class="control-label" for=""></label>
              <div class="controls">
              <select id="" name="" class="input-xlarge" style="margin-top:-0px;">
<?php
include("db/conexion.php"); 

$bd_servidor = $dbhost;
$bd_usuario = $dbusuario;
$bd_contrasenya = $dbpassword;
$bd_bdname = $db;

$bd_tabla_estados = "estados";

$link = mysql_connect($bd_servidor,$bd_usuario,$bd_contrasenya);
mysql_select_db($bd_bdname,$link);
mysql_query("SET NAMES 'utf8'");

$result = mysql_query("SHOW FIELDS from `$bd_tabla_estados`",$link);
while($row = mysql_fetch_row($result)) { }
$query = "select * from $bd_tabla_estados";

$result = mysql_query($query,$link);
$found = false; 
while ($row = mysql_fetch_array($result)) {
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
mysql_free_result($result);
?>
                </select>
              </div>
            </div>
            
            <!-- Multiple Checkboxes (inline) -->
            <div class="control-group">
              <label class="control-label" for=""></label>
              <div class="controls">
                <label class="checkbox inline" for="-0">
                  <input type="checkbox" name="" id="-0" value="Acepto términos y condiciones, así como política de privacidad" required>
                  Acepto términos y condiciones, así como política de privacidad
                </label>
              </div>
            </div>
            
            <!-- Button -->
            <div class="control-group">
              <label class="control-label" for=""></label>
              <div class="controls">
                <button id="enviar_form" name="" class="btn btn-default">enviar</button>
              </div>
            </div>
            
            </fieldset>
            </form>
        </div>
      </div>
      
        <HR width=100% align="left">
   
    <div class="row">
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-6"><h1>Promoción 1</h1>
<p>Lorem ipsum dolor sit amet,
consectetuer adipiscing elit. Aenean
commodo ligula eget dolor. Aenean
massa. Cum sociis natoque penatibus
et magnis dis parturient montes,
nascetur ridiculus mus. Donec quam
felis, ultricies nec, pellentesque eu,
pretium quis, sem.</p></div>
          <div class="col-md-6"><img src="img/romance.jpg" /></div>
        </div>
        <HR width=100% align="left">
        <div class="row">
          <div class="col-md-6"><h1>Promoción 2</h1>
<p>Lorem ipsum dolor sit amet,
consectetuer adipiscing elit. Aenean
commodo ligula eget dolor. Aenean
massa. Cum sociis natoque penatibus
et magnis dis parturient montes,
nascetur ridiculus mus. Donec quam
felis, ultricies nec, pellentesque eu,
pretium quis, sem.</p></div>
          <div class="col-md-6"><img src="img/vino.jpg" /></div>
        </div>
        <HR width=100% align="left">
        <div class="row">
         <div class="col-md-6"><h1>Promoción 3</h1>
<p>Lorem ipsum dolor sit amet,
consectetuer adipiscing elit. Aenean
commodo ligula eget dolor. Aenean
massa. Cum sociis natoque penatibus
et magnis dis parturient montes,
nascetur ridiculus mus. Donec quam
felis, ultricies nec, pellentesque eu,
pretium quis, sem.</p></div>
          <div class="col-md-6"><img src="img/palapa.jpg" /></div>
        </div>
        </div>
        <div class="col-md-4">
        <img src="img/flores.jpg" style="margin:20px;" />
        <img src="img/vestido.jpg" style="margin:20px;" />
      </div>
    </div>

    </div><!-- /.container -->
    <div class="container">
    
    </div>
    
<?php require("footer.php") ?>