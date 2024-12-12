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
    $nombre_socio = recoge('nombre_socio');
    $dia = recoge('dia');
    $mesa_numero = recoge('mesa_numero');

    // Conectar a la base de datos
    try {
        // Conectar con la base de datos
        $conn = conectarBaseDatos();

        // Preparar la consulta SQL para insertar los datos de la reserva
        $sql = "INSERT INTO reserva (nombre_socio, dia, mesa_numero) 
                VALUES (:nombre_socio, :dia, :mesa_numero)";
        $stmt = $conn->prepare($sql);

        // Vincular los parámetros a los valores del formulario
        $stmt->bindParam(':nombre_socio', $nombre_socio);
        $stmt->bindParam(':dia', $dia);
        $stmt->bindParam(':mesa_numero', $mesa_numero);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<p>Reserva realizada correctamente.</p>";
        } else {
            echo "<p>Error al realizar la reserva.</p>";
        }

    } catch (PDOException $e) {
        echo "<p>Error en la conexión o en la consulta: " . $e->getMessage() . "</p>";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Reserva</title>
    <link rel="stylesheet" type="text/css" href="style.css">  <!-- Enlace al archivo CSS -->
</head>

<button class="enlace-boton">
    <p><a href="ver_reservas.php">Ver todas las reservas</a></p>
</button>
<button class="enlace-boton">
    <p><a href="principal.php">Volver a la Página Principal</a></p>
</button>

