<?php
    session_start();
    include("conexion_bd.php");

    
    // Mostrar la información de $_POST en la consola del navegador
    header('Content-Type: application/json');
    echo json_encode($_POST);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
        $idUsuario = $_SESSION['usuario_id'];

        if (isset($_POST['idArticulo']) && isset($_POST['nuevaCantidad'])) {
            $idArticulo = $_POST['idArticulo'];
            $nuevaCantidad = $_POST['nuevaCantidad'];

            // Actualizar la cantidad del artículo en el carrito para el usuario actual
            $queryUpdate = "UPDATE carrito SET cantidad = '$nuevaCantidad' 
                            WHERE id_usuario = '$idUsuario' AND id_articulo = '$idArticulo'";

            if ($conn->query($queryUpdate) === TRUE) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'error' => 'Error al actualizar la cantidad: ' . $conn->error));
            }
        } else {
            echo json_encode(array('success' => false, 'error' => 'Datos incompletos'));
        }
    } else {
        echo json_encode(array('success' => false, 'error' => 'Acceso no autorizado'));
    }

    $conn->close();
?>