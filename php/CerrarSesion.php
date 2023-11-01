<?php

    // Inicia la sesión
    session_start();

    // Cierra la sesión
    session_destroy();

    // Redirige a la página de inicio de sesión u otra página deseada
    header("Location: ../index.php");
    exit();

?>