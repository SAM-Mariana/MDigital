<?php
include_once 'logger.php';
include_once 'confii.php';

$conn = uescribir();

// Verificar la conexión

if ($conn->connect_error) {

    die("La conexión falló: " . $comn->connect_error);

}
#cgi no se podra abrir en la consola
if(php_sapi_name()!=='apache2handler'){
    die("No pudes abrirlo desde la consila");
}




// Verificar si se ha enviado una categoría

if (isset($_POST['categorias'])) {

    $categoriaSeleccionada = $_POST['categorias'];




    // Verificar si la categoría ya existe en la base de datos

    $sql = "SELECT * FROM categorias WHERE nombre =

     '$categoriaSeleccionada'";

    $result = $conn->query($sql);




    if ($result->num_rows > 0) {

        // La categoría ya existe

        echo "Has seleccionado la categoría existente: "

        . $categoriaSeleccionada;

    } else {

        // La categoría no existe, insertarla en la base de datos

        $sqlInsert = "INSERT INTO categorias (nombre) VALUES ('$categoriaSeleccionada')";
        loggerRegistro($conn, $sql);
        if ($conn->query($sqlInsert) === TRUE) {

            echo "Has seleccionado y creado la categoría: " . $categoriaSeleccionada;

        } else {

            echo "Error al crear la categoría: " . $conn->error;

        }

    }

} else {

    echo "No se ha seleccionado ninguna categoría.";

}




// Cerrar la conexión

$conn->close();

?>