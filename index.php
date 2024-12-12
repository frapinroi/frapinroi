<?php
require_once "comunes/biblioteca.php";

// Inicia la sesión
session_name("sesiondb");
session_start();

// Si ya está conectado, redirige a la página principal
if (isset($_SESSION["conectado"])) {
    header("Location: principal.php");
    exit;
}

cabecera("Login"); // Aquí invocas la cabecera de tu página

$aviso = recoge("aviso");
if ($aviso != "") {
    print "    <p class=\"aviso\">$aviso</p>\n";
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Enlace al archivo CSS externo -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<!-- Formulario de Login -->
<form action="login-2.php" method="post">
  <p>Escriba su nombre de usuario y contraseña:</p>
  <table>
    <tr>
      <td>Usuario:</td>
      <td><input type="text" name="usuario" required autofocus /></td>
    </tr>
    <tr>
      <td>Contraseña:</td>
      <td><input type="password" name="password" required /></td>
    </tr>
  </table>

  <p>
    <input type="submit" value="Identificar">
    <input type="reset" value="Borrar">
  </p>
</form>

<?php pie(); ?>
