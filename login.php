<?php
session_start();
if (!empty($_SESSION["usuario"])) {
    header("Location: ./index.php");
    exit();
}
$palabra_secreta_correcta = "admin";

include('./conexion.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
    
    $myusername = mysqli_real_escape_string($db,$_POST['usuario']);
    $mypassword = mysqli_real_escape_string($db,$_POST['clave']); 

    $sql = "SELECT * FROM usuarios WHERE usuario = '$myusername'";
    $query = $db->query($sql);
    $user = $query->fetch_assoc();
    $clave_correcta = $user['clave'];

   

    if($user && password_verify($mypassword , $clave_correcta)) {
        if($_POST['sesion']){
            session_start([
                'cookie_lifetime' => 86400,
                'gc_maxlifetime' => 86400,
            ]);
        }else{
            session_start();
        }
        //Uso sesSion en vez de cookie porque guarda los datos del lado del servidor
        // dejando del lado del cliente solo un identificador 
       $_SESSION['usuario'] = $myusername;
       header("location: index.php");
    }else {
       $error = "Your Login Name or Password is invalid";
       header("location: index.php");
    }

}
