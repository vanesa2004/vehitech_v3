<?php
session_start();
include("conexion_bd.php");

if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    // El usuario está logueado, proceder a agregar al carrito
    if (isset($_POST['idArticulo']) && isset($_POST['cantidad'])) {
        $idArticulo = $_POST['idArticulo'];
        $cantidadNueva = $_POST['cantidad'];
        $idUsuario = $_SESSION['usuario_id'];

        // Obtener información del producto desde la base de datos
        $queryProducto = "SELECT * FROM articulos WHERE id_articulo = $idArticulo";
        $resultProducto = $conn->query($queryProducto);

        if ($resultProducto->num_rows > 0) {
            $producto = $resultProducto->fetch_assoc();
            $precio = $producto['precio'];

            // Verificar si el artículo ya está en el carrito del usuario
            $queryCheck = "SELECT * FROM carrito WHERE id_usuario = '$idUsuario' AND id_articulo = '$idArticulo'";
            $resultCheck = $conn->query($queryCheck);

            if ($resultCheck->num_rows > 0) {
                // El artículo ya está en el carrito, obtener la cantidad actual y el total actual
                $row = $resultCheck->fetch_assoc();
                $cantidadActual = $row['cantidad'];
                $totalActual = $row['total'];

                // Calcular la nueva cantidad y el nuevo total
                $cantidadTotal = $cantidadActual + $cantidadNueva;
                $totalNuevo = $precio * $cantidadTotal;

                // Actualizar la cantidad y el total en la tabla carrito
                $queryUpdate = "UPDATE carrito SET cantidad = '$cantidadTotal', total = '$totalNuevo' WHERE id_usuario = '$idUsuario' AND id_articulo = '$idArticulo'";
                if ($conn->query($queryUpdate) === TRUE) {
                    echo "Cantidad y total actualizados en el carrito";
                } else {
                    echo "Error al actualizar la cantidad y el total en el carrito: " . $conn->error;
                }
            } else {
                // El artículo no está en el carrito, insertar un nuevo registro
                $total = $precio * $cantidadNueva;

                // Insertar en la tabla carrito
                $queryInsert = "INSERT INTO carrito (id_usuario, id_articulo, cantidad, total) VALUES ('$idUsuario', '$idArticulo', '$cantidadNueva', '$total')";
                if ($conn->query($queryInsert) === TRUE) {
                    echo "Producto agregado al carrito con éxito";
                } else {
                    echo "Error al agregar el producto al carrito: " . $conn->error;
                }
            }
        } else {
            echo "Producto no encontrado";
        }
    } else {
        echo "Datos del producto incompletos";
    }
} else {
    // El usuario no está logueado, redirigir al login
    header('Location: ../pages/login.php');
    exit();
}

$conn->close();
?>