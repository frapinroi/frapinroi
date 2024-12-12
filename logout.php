<?php
session_name("sesiondb");
session_start();

// Destruir la sesión
session_destroy();

// Redirigir al login
header("Location: index.php");
exit;
?>
