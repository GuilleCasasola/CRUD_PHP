<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mis tareas</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">

	<style>
		.content {
			margin-top: 80px;
		}
	</style>

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include('nav.php');?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Notas</h2>
			<hr />

			<?php
			if(isset($_GET['aksi']) == 'delete'){
				// escaping, additionally removing everything that could be (html/javascript-) code
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($con, "SELECT * FROM notas WHERE id='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($con, "DELETE FROM notas WHERE id='$nik'");
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>

			<form class="form-inline" method="get">
	
					<div class="form-group col-12 w-100">
						<select name="filter" class="form-control" onchange="form.submit()">
							<option value="0">Filtros por estado</option>
							<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
							<option value="pendiente" <?php if($filter == 'pendiente'){ echo 'selected'; } ?>>Pendiente</option>
							<option value="en curso" <?php if($filter == 'en curso'){ echo 'selected'; } ?>>En curso</option>
							<option value="realizada" <?php if($filter == 'realizada'){ echo 'selected'; } ?>>Realizadas</option>
						</select>
							<a href="add.php" class="btn btn-success float-right"> + Agregar nota</a>
					</div>
					
	
			</form>
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                    <th>Id</th>
					<th>Descripcion</th>
                    <th>Fecha Limite</th>
					<th>Estado</th>
                    <th>Acciones</th>
				</tr>
				<?php
				if($filter){
					$sql = mysqli_query($con, "SELECT * FROM notas WHERE estado='$filter' ORDER BY id DESC");
				}else{
					$sql = mysqli_query($con, "SELECT * FROM notas ORDER BY id DESC");
				}
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$row['id'].'</td>
							<td><a href="profile.php?nik='.$row['id'].'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$row['descripcion'].'</a></td>
                            <td>'.$row['fecha_limite'].'</td>
							<td>';
							if($row['estado'] == 'pendiente'){
								echo '<span class="label label-success">Pendiente</span>';
							}
                            else if ($row['estado'] == 'en curso' ){
								echo '<span class="label label-info">En Curso</span>';
							}
                            else if ($row['estado'] == 'terminada' ){
								echo '<span class="label label-warning">Done</span>';
							}
						echo '
							</td>
							<td>
								<a href="edit.php?nik='.$row['id'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true">Editar</span></a>
								<a href="index.php?aksi=delete&nik='.$row['id'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['descripcion'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true">Borrar</span></a>
							</td>
						</tr>
						';
					}
				}
				?>
			</table>
			</div>
		</div>
	</div>
    <center>
	<p>&copy; SSDD Web <?php echo date("Y");?></p
	</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>