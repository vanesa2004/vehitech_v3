<?php

// Verifica si la sesión está iniciada
if (isset($_SESSION['isLoggedIn'])) {
    // La sesión está iniciada
    echo "sesion_iniciada";
} else {
    // La sesión no está iniciada
    echo "sesion_no_iniciada";
}
?>