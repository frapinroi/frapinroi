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
    $reserva_id = recoge('reserva_id');
    $socio_nombre = recoge('socio_nombre');

    // Conectar a la base de datos
    try {
        // Conectar con la base de datos
        $conn = conectarBaseDatos();

        // Preparar la consulta SQL para verificar la existencia de la reserva
        $sql_check = "SELECT * FROM reserva WHERE id_reserva = :id_reserva AND nombre_socio = :nombre_socio";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bindParam(':id_reserva', $reserva_id);
        $stmt_check->bindParam(':nombre_socio', $socio_nombre);
        $stmt_check->execute();

        // Verificar si la reserva existe
        if ($stmt_check->rowCount() > 0) {
            // Preparar la consulta SQL para eliminar la reserva
            $sql_delete = "DELETE FROM reserva WHERE id_reserva = :id_reserva AND nombre_socio = :nombre_socio";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bindParam(':id_reserva', $reserva_id);
            $stmt_delete->bindParam(':nombre_socio', $socio_nombre);

            // Ejecutar la consulta de eliminación
            if ($stmt_delete->execute()) {
                echo "<p>Reserva eliminada correctamente.</p>";
            } else {
                echo "<p>Error al eliminar la reserva.</p>";
            }
        } else {
            echo "<p>No se encontró la reserva con el ID y nombre proporcionados.</p>";
        }

    } catch (PDOException $e) {
        echo "<p>Error en la conexión o en la consulta: " . $e->getMessage() . "</p>";
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Reserva</title>
    <link rel="stylesheet" type="text/css" href="style.css">  <!-- Enlace al archivo CSS -->
</head>

<h1 class="title">Eliminar Reserva</h1>

<!-- Formulario para ingresar los datos de la reserva a eliminar -->
<form action="procesar_eliminar_reserva.php" method="POST">
    <div>
        <label for="reserva_id">ID de la Reserva:</label>
        <input type="text" id="reserva_id" name="reserva_id" required>
    </div>
    <div>
        <label for="socio_nombre">Nombre del Socio:</label>
        <input type="text" id="socio_nombre" name="socio_nombre" required>
    </div>
    <div>
        <input type="submit" value="Eliminar Reserva">
    </div>
</form>

<button class="boton-blanco">
    <p><a href="ver_reservas.php">Ver todas las reservas</a></p>
</button>
<button class="boton-blanco">
    <p><a href="principal.php">Volver a la Página Principal</a></p>
</button>
