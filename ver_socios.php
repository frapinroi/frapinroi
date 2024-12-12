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

    // Preparar la consulta para obtener todos los socios
    $sql = "SELECT id, nombre, apellido, email, telefono, direccion FROM socios";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Obtener los resultados
    $socios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Incluir la cabecera con el título y CSS
    cabecera("Lista de Socios");
    echo "<link rel='stylesheet' type='text/css' href='style.css'>";

    // Título principal fuera del cuadro blanco
    echo "<h1 class='title'>Lista de Socios</h1>";

    // Contenedor principal para la tabla
    echo "<div class='container'>";

    // Crear la tabla con los datos de los socios
    echo "<table class='socios-table'>";
    echo "<thead><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Teléfono</th><th>Dirección</th></tr></thead>";
    echo "<tbody>";

    foreach ($socios as $socio) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($socio['id']) . "</td>";
        echo "<td>" . htmlspecialchars($socio['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($socio['apellido']) . "</td>";
        echo "<td>" . htmlspecialchars($socio['email']) . "</td>";
        echo "<td>" . htmlspecialchars($socio['telefono']) . "</td>";
        echo "<td>" . htmlspecialchars($socio['direccion']) . "</td>";
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
    <title>Introducir Nuevo Socio</title>
    <link rel="stylesheet" type="text/css" href="style.css">  <!-- Enlace al archivo CSS -->
</head>
<button class="enlace-boton">
<p><a href='principal.php'>Volver a la Página Principal</a></p>
</button>

