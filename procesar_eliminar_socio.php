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
    $socio_id = recoge('socio_id');
    $socio_nombre = recoge('socio_nombre');

    // Conectar a la base de datos
    try {
        // Conectar con la base de datos
        $conn = conectarBaseDatos();

        // Preparar la consulta SQL para verificar la existencia del socio
        $sql_check = "SELECT * FROM socios WHERE id = :id AND nombre = :nombre";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bindParam(':id', $socio_id);
        $stmt_check->bindParam(':nombre', $socio_nombre);
        $stmt_check->execute();

        // Verificar si el socio existe
        if ($stmt_check->rowCount() > 0) {
            // Preparar la consulta SQL para eliminar el socio
            $sql_delete = "DELETE FROM socios WHERE id = :id AND nombre = :nombre";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bindParam(':id', $socio_id);
            $stmt_delete->bindParam(':nombre', $socio_nombre);

            // Ejecutar la consulta de eliminación
            if ($stmt_delete->execute()) {
                echo "<p>Socio eliminado correctamente.</p>";
            } else {
                echo "<p>Error al eliminar el socio.</p>";
            }
        } else {
            echo "<p>No se encontró el socio con el ID y nombre proporcionados.</p>";
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
<button class="boton-blanco">
<p><a href="ver_socios.php">Ver todos los socios</a></p>
</button>
<button class="boton-blanco">
<p><a href="principal.php">Volver a la Página Principal</a></p>
</button>


