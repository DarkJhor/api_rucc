<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>	
<body>

<div class="container">
	<div class="row">
		<div class="col s6 l6 m6">
			<div class="card">
				<div class="card-title center">
				    <h6>CONSULTA DE RUC</h6>					
				</div>
				<div class="card-content center">
					<form method="POST" action="<<?php echo $_SERVER["PHP_SELF"]; ?>">
						<input type="number" name="ruc" value="" placeholder="Ingrese su RUC">
						<button type="submit" class="btn-large red">CONSULTA</button>
					</form>					
				</div>
				<div class="card-action">
					
				</div>				
			</div>			
		</div>		
	</div>	
</div>
<?php 
if (!isset($POST['ruc'])){

}else{
	//DECLARANDO LA VARIABLE
	$ruc_consulta = htmlentities($_POST['ruc']);
	//USANDO LA API
	$url ="https://dniruc.apisperu.com/api/v1/ruc/".$ruc_consulta."?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im1heG1jbV92aXBAaG90bWFpbC5jb20ifQ.0xkHI_pPqS2CA3bK0UldWZqzjfp26jJHr7GQuJGahlU";
	//SACANDO LA INFORMACION ARCHIVO
	$archivo_json = file_get_contents($url);
	//CONVERCION JSON
	$datos = json_decode($archivo_json);
	//EXTRAER LOS DATOS POR VALORES DEASDE JSON
	$ruc_valido = $datos->{'ruc'};
	$nombre_empresa = $datos->{'razonSocial'};
	$tipo_negocio = $datos->{'tipo'};
	$direccion = $datos->{'direccion'};
?>
<div class="container">
	<div class="row">
		<div class="col s8 l8 m8">
			<div class="card">
				<div class="card-title">
					<?php 
					    if ($ruc_valido) {
						    echo "SU RUC ES VALIDO :".$ruc_valido;
						    header("Refresh:10;URL=index.php");    
					    }else{
						    echo "SU RUC NO ES VALIDO VUELVA A CONSULTARLO";
						    header("Refresh:10;URL=index.php");
					    }
					 ?>					
				</div>
				<div class="card-content">
					<?php if ($ruc_valido) {
						echo "EL RUC LE PERTENECE A ".$nombre_empresa. "DE TIPO DE NEGOCIO ".$tipo." con direccion ".$direccion;
						header("Refresh:10;URL=index.php");
					}else{
						echo("SU RUC NO ES VALIDO VUELVA A CONSULTARLO");
						header("Refresh:10;URL=index.php");
					}
					 ?>					
				</div>				
			</div>			
		</div>		
	</div>	
</div>


<?php
}


?>






<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
</body>
</html>