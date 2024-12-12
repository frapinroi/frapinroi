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

    // Consulta SQL para obtener los días con el número de reservas por día
    $sql = "SELECT dia, COUNT(*) AS num_reservas
            FROM reserva
            GROUP BY dia
            ORDER BY dia ASC";
    
    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Verificar si hay resultados
    if ($stmt->rowCount() > 0) {
        // Incluir la cabecera con el título y CSS
        cabecera("Días con Reservas");

        // Estilo y título de la página
        echo "<link rel='stylesheet' type='text/css' href='style.css'>";
        echo "<h1 class='title'>Días con Reservas</h1>";

        // Contenedor principal para la tabla
        echo "<div class='container'>";

        // Crear la tabla con los datos de las reservas
        echo "<table class='socios-table'>";
        echo "<thead><tr><th>Fecha</th><th>Número de Reservas</th></tr></thead>";
        echo "<tbody>";

        // Mostrar los resultados
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['dia']) . "</td>";
            echo "<td>" . htmlspecialchars($row['num_reservas']) . "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
        echo "</div>";

    } else {
        echo "<p>No hay reservas registradas en los días.</p>";
    }
} catch (PDOException $e) {
    echo "<div class='container'><p>Error en la conexión o en la consulta: " . $e->getMessage() . "</p></div>";
}
?>

<!-- Botón de enlace con el estilo 'enlace-boton' -->
<button class="enlace-boton">
    <p><a href="principal.php">Volver a la Página Principal</a></p>
</button>
