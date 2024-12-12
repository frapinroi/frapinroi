<?php
session_name("sesiondb");
session_start();

require_once "comunes/biblioteca.php";

// Definir el usuario y contraseña válidos (puedes cambiarlos por lo que prefieras)
$usuario_valido = "fpineda";
$clave_valida = "123456";

// Recoger los datos del formulario
$usuario = recoge("usuario");
$password = recoge("password");

// Verificar si el usuario y contraseña son correctos
if ($usuario == $usuario_valido && $password == $clave_valida) {
    // Si son correctos, crear la sesión y redirigir
    $_SESSION["conectado"] = true;
    header("Location: principal.php");
    exit;
} else {
    // Si no son correctos, redirigir al login con un aviso
    header("Location: index.php?aviso=Usuario o contraseña incorrectos");
    exit;
}
?>
