<?php

include_once 'encriptar.php';
include_once 'confii.php';


if ($conn -> connect_error){

    echo "Error en la conexion";

}else{

  #cgi no se podra abrir en la consola
    if(php_sapi_name()!=='apache2handler'){
        die("No pudes abrirlo desde la consila");
    }
    #"echo "conexion exitosa";

    

    $ciudad = $_POST ['Ciudad'];

    $colonia =$_POST ['Coloni'];

    $calle =$_POST ['Calle'];

    $cp =$_POST ['C_P'];

    $numero =$_POST ['Numero'];


    $regex = "/[^a-zA-Z0-9@._]/";

    

    $ciudad = preg_replace($regex, "", $ciudad);

    $colonia = preg_replace($regex, "", $colonia);

    $calle = preg_replace($regex, "", $calle);

    $cp = preg_replace($regex, "", $cp);

    $numero = preg_replace($regex, "", $numero);

  $sql = "INSERT INTO direccion ( Ciudad, Coloni, Calle, C_P, Numero) VALUES ( '$ciudad', '$colonia', '$calle', '$cp', '$numero')";
  if ($conn -> query ($sql)=== TRUE )  {



    echo "registro de direccion exitosamente";

    # code...

 }else{

    echo "error en tu registro";

    

 }

}
?>