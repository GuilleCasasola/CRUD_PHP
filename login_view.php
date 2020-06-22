<?php
    session_start();
    if (!empty($_SESSION["usuario"])) {
        header("Location: ./index.php");
        exit();
    }
?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title> Ingresar a Notas </title>
  </head>
  <body class="row-active h-100 bg-secondary">


    <!-- ******************************** CONTENEDOR *********************************-->
        <div class="container-fluid p-0 bg-active border h-100 ">

                        
            <!-- ****** Se va a procesar en login.php y se enviará por POST, no por GET ****** -->
            <div class="row justify-content-center align-items-center row-search h-100">
                <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3 bg-light">
                    <br>
                    <h4 class="text-center"> Ingresar a Notas</h4>
                    
                    <form action="login.php" class="block" method="post">
                        <label for="usuario">Usuario: (demo)</label>
                        <input name="usuario" class="w-100" type="text" placeholder="Ingrese Usuario">
                        <br>
                        <!-- Nota: el atributo name es importante, pues lo vamos a recibir de esa manera en PHP  -->
                        <label for="clave">Clave: (demo)</label>
                        <input name="clave" class="w-100" type="password" placeholder="Ingrese clave">
                        <br>
                        <br>
                        <input name="sesion" type="checkbox" > <i>Mantener sesion iniciada</i>
                        <br><br>
                        <!--Lo siguiente envía el formulario-->
                        <input type="submit" class="btn btn-primary btn-block" value="Entrar">
                        <br>
                      
                    </form>

                    
                </div>
            </div>
            

        </div>

        <!-- ****************************** FIN CONTENEDOR **********************************-->
</body>
</html>

