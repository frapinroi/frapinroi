<?php
// Función para conectar a la base de datos
function conectarBaseDatos() {
    $servername = "172.16.4.113";  // IP del servidor MariaDB
    $username = "fpineda";         // Usuario
    $password = "123456";          // Contraseña
    $dbname = "fp_db";             // Base de datos

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Error al conectar a la base de datos: " . $e->getMessage());
    }
}

// Función para recoger datos del formulario de manera segura
function recoge($var) {
    if (isset($_REQUEST[$var])) {
        return htmlspecialchars($_REQUEST[$var], ENT_QUOTES, 'UTF-8');
    }
    return "";
}

// Funciones de cabecera y pie
function cabecera($titulo) {
    echo "<!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>$titulo</title></head><body>";
}

function pie() {
    echo "</body></html>";
}
?>
