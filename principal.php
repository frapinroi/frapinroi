<?php
session_name("sesiondb");
session_start();

require_once "comunes/biblioteca.php";

// Verificar si está conectado
if (!isset($_SESSION["conectado"]) || !$_SESSION["conectado"]) {
    header("Location: index.php");
    exit;
}

cabecera("Página Principal");

echo "<h1 class='title'>Gestión de Socios</h1><br>";

// Botones para la gestión de socios y reservas
echo "<div class='container'>";
echo "  <div class='left-box'>";
echo "    <button onclick='window.location.href=\"ver_socios.php\"'>Ver Socios</button>";
echo "    <button onclick='window.location.href=\"borrar_socios.php\"'>Borrar Socios</button>";
echo "    <button onclick='window.location.href=\"introducir_socio.php\"'>Introducir Socio Nuevo</button>";
echo "  </div>";
echo "  <div class='right-box'>";
echo "    <button onclick='window.location.href=\"reservar.php\"'>Hacer reserva</button>";
echo "    <button onclick='window.location.href=\"ver_reservas.php\"'>Ver Reservas</button>";
echo "    <button onclick='window.location.href=\"borrar_reserva.php\"'>Borrar Reserva</button>";
echo "  </div>";
echo "  </div>";
echo "  <div class='right-box'>";
echo "    <button onclick='window.location.href=\"reservar.php\"'>prueba</button>";

echo "  </div>";
echo "</div>";


pie();
?>
<!-- Enlace al archivo CSS externo -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<button class="enlace-boton">
<p><a href="logout.php">Cerrar sesión</a></p>
</button>