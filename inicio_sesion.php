
<?php

 include_once 'confi.php';
 include_once 'encriptar.php';
 include_once 'logger.php';

 $conn = uescribir();

 if($conn -> connect_error){

     echo"ERROR DE LA CONEXION";

 }else{
    #cgi no se podra abrir en la consola
    if(php_sapi_name()!=='apache2handler'){
        die("No pudes abrirlo desde la consila");
    }

    $correo =$_POST ['Correo'];

    $contraseña =encriptar($_POST ['Contraseña']);

    $regex = "/[^a-zA-Z0-9@._]/";

    $correo = preg_replace($regex, "", $correo);

    $contraseña = preg_replace($regex, "", $contraseña);

    $sql="SELECT * FROM usuarios WHERE Correo='$correo' AND Contraseña='$contraseña'";
    loggerRegistro($conn, $sql);
    $resultado = $conn -> query ($sql);

if($resultado -> num_rows > 0){
echo $e;
    header('Location:registro.html');
} else {

    header('Location:index.html');
    
 }
 
 $conn -> close();
 }

?>