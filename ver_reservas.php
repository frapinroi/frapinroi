<?php
session_name("sesiondb");
session_start();
require_once "comunes/biblioteca.php";

// Verificar que el usuario esté conectado
if (!isset($_SESSION["conectado"]) || !$_SESSION["conectado"]) {
    header("Location: index.php");
    exit;
}

try {
    // Conectar con la base de datos
    $conn = conectarBaseDatos();

    // Preparar la consulta para obtener todas las reservas
    $sql = "SELECT id_reserva, nombre_socio, dia, mesa_numero FROM reserva";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Obtener los resultados
    $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Incluir la cabecera con el título y CSS
    cabecera("Lista de Reservas");
    echo "<link rel='stylesheet' type='text/css' href='style.css'>";

    // Título principal fuera del cuadro blanco
    echo "<h1 class='title'>Lista de Reservas</h1>";

    // Contenedor principal para la tabla
    echo "<div class='container'>";

    // Crear la tabla con los datos de las reservas
    echo "<table class='socios-table'>";
    echo "<thead><tr><th>ID Reserva</th><th>Nombre Socio</th><th>Fecha</th><th>Mesa Nº</th></tr></thead>";
    echo "<tbody>";

    foreach ($reservas as $reserva) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($reserva['id_reserva']) . "</td>";
        echo "<td>" . htmlspecialchars($reserva['nombre_socio']) . "</td>";
        echo "<td>" . htmlspecialchars($reserva['dia']) . "</td>";
        echo "<td>" . htmlspecialchars($reserva['mesa_numero']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
    echo "</div>";

    // Pie de página
    pie();
} catch (PDOException $e) {
    echo "<div class='container'><p>Error al consultar los datos: " . $e->getMessage() . "</p></div>";
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Reservas</title>
    <link rel="stylesheet" type="text/css" href="style.css">  <!-- Enlace al archivo CSS -->
</head>

<button class="enlace-boton">
    <p><a href='principal.php'>Volver a la Página Principal</a></p>
</button>
