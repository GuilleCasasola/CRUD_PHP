<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SD10</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include("nav.php");?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Notas &raquo; Agregar nota</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
				$descripcion		     = mysqli_real_escape_string($db,(strip_tags($_POST["descripcion"],ENT_QUOTES)));//Escanpando caracteres 
				$fecha_limite	 = mysqli_real_escape_string($db,(strip_tags($_POST["fecha_limite"],ENT_QUOTES)));//Escanpando caracteres 
				$estado	     = mysqli_real_escape_string($db,(strip_tags($_POST["estado"],ENT_QUOTES)));//Escanpando caracteres 

				$insert = mysqli_query($db, "INSERT INTO notas(descripcion,fecha_limite, estado)
													VALUES('$descripcion','$fecha_limite','$estado')");
				if($insert){
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
				}
					 
			}
			?>

			<form class="form-horizontal" action="" method="post">
				
				<div class="form-group">
					<label class="col-sm-12 control-label">Descripción</label>
					<div class="col-sm-12">
						<input type="text" name="descripcion" class="form-control" placeholder="Ingrese Nota" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha de Limite</label>
					<div class="col-sm-4">
						<input type="date" name="fecha_limite" class="input-group date form-control" date="" data-date-format="dd-mm-yyyy" placeholder="00-00-0000" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Estado</label>
					<div class="col-sm-4">
						<select name="estado" class="form-control">
							<option value=""> ----- </option>
                           	<option value="pendiente">Pendiente</option>
							<option value="en curso">En Curso</option>
							<option value="realizada">Realizada</option>
						</select>
					</div>
				</div>				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>