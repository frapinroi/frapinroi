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
cabecera("Hacer Reserva");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacer Reserva</title>
    <link rel="stylesheet" type="text/css" href="style.css">  <!-- Enlace al archivo CSS -->
</head>

<h1 class="title">Hacer Reserva</h1>

<!-- Formulario para ingresar los datos de la reserva -->
<form action="procesar_reserva.php" method="POST">
    <div>
        <label for="nombre_socio">Nombre del Socio:</label>
        <input type="text" id="nombre_socio" name="nombre_socio" required>
    </div>
    <div>
        <label for="dia">Fecha de Reserva:</label>
        <input type="date" id="dia" name="dia" required>
    </div>
    <div>
        <label for="mesa_numero">Número de Mesa:</label>
        <input type="number" id="mesa_numero" name="mesa_numero" required>
    </div>
    <div>
        <input type="submit" value="Hacer Reserva">
    </div>
</form>

<!-- Botón para volver a la página principal -->
<button class="enlace-boton">
    <p><a href="principal.php">Volver a la Página Principal</a></p>
</button>

<?php
// Pie de página si es necesario
pie();
?>
