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

cabecera("Introducir Socio Nuevo");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introducir Nuevo Socio</title>
    <link rel="stylesheet" type="text/css" href="style.css">  <!-- Enlace al archivo CSS -->
</head>

<h1 class="title">Introducir Nuevo Socio</h1>

<!-- Formulario para ingresar los datos del socio -->
<form action="procesar_socio.php" method="POST">
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
    </div>
    <div>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
    </div>
    <div>
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" required>
    </div>
    <div>
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required>
    </div>
    <div>
        <input type="submit" value="Guardar Socio">
    </div>
</form>


<button class="enlace-boton">
<p><a href="principal.php">Volver a la Página Principal</a></p>
</button>
<?php
// Pie de página si es necesario
pie();
?>
