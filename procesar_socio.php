<?php
session_name("sesiondb");
session_start();
require_once "comunes/biblioteca.php";
// Verificar que el usuario esté conectado
if (!isset($_SESSION["conectado"]) || !$_SESSION["conectado"]) {
    header("Location: index.php");
    exit;
}

// Verificar si los datos fueron enviados por el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario de manera segura
    $nombre = recoge('nombre');
    $apellido = recoge('apellido');
    $email = recoge('email');
    $telefono = recoge('telefono');
    $direccion = recoge('direccion');

    // Conectar a la base de datos
 

    try {
        // Conectar con la base de datos
        $conn = conectarBaseDatos();

        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO socios (nombre, apellido, email, telefono, direccion) 
                VALUES (:nombre, :apellido, :email, :telefono, :direccion)";
        $stmt = $conn->prepare($sql);

        // Vincular los parámetros a los valores del formulario
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':direccion', $direccion);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<p>Socio añadido correctamente.</p>";
        } else {
            echo "<p>Error al agregar el socio.</p>";
        }

    } catch (PDOException $e) {
        echo "<p>Error en la conexión o en la consulta: " . $e->getMessage() . "</p>";
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introducir Nuevo Socio</title>
    <link rel="stylesheet" type="text/css" href="style.css">  <!-- Enlace al archivo CSS -->
</head>
<button class="enlace-boton">
<p><a href="ver_socios.php">Ver todos los socios</a></p>
</button>
<button class="enlace-boton">
<p><a href="principal.php">Volver a la Página Principal</a></p>
</button>

