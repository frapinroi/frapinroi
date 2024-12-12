<?php
session_name("sesiondb");
session_start();
require_once "comunes/biblioteca.php";

// Asegúrate de que el usuario esté conectado
if (!isset($_SESSION["conectado"]) || !$_SESSION["conectado"]) {
    header("Location: index.php");
    exit;
}

// Incluye la cabecera (si la tienes en biblioteca.php)
cabecera("Eliminar Reserva");
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

<button class="enlace-boton">
    <p><a href="ver_reservas.php">Ver todas las reservas</a></p>
</button>
<button class="enlace-boton">
    <p><a href="principal.php">Volver a la Página Principal</a></p>
</button>

<?php
// Pie de página si es necesario
pie();
?>
