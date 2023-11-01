<?php

    session_start();
    include("conexion_bd.php");

    $usuarioId = "";

    // Verificar si el usuario ha iniciado sesión como cliente
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] && $_SESSION['usuario_rol'] === 'cliente') {
        // Verificar si la variable de sesión usuario_id está definida
        if (isset($_SESSION['usuario_id'])) {
            // Obtener el ID del usuario
            $usuarioId = $_SESSION['usuario_id'];
            echo "El valor de usuario_id es: " . $usuarioId;
        }

        // Obtener los datos del formulario de cotización
        $nombreArticulo = $_POST['nombrearticulo'];
        $descripcion = $_POST['descripcionarticulo'];
        $accion = $_POST['accion'];
        $visibleAdmin = 1;

        // Establecer la zona horaria a la deseada
        date_default_timezone_set('America/Bogota');
        // Obtener la fecha actual
        $fechaActual = date("Y-m-d");

        // Verificar si se ha seleccionado una foto
        if (!empty($_FILES['archivo']['name'])) {
            $nombreArchivo = $_FILES['archivo']['name'];
            $rutaArchivo = "../img/cotizaciones/" . $nombreArchivo;

            // Mover la foto al directorio en el servidor
            move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo);

            // Guardar la ruta de la imagen en la base de datos
            $sql = "INSERT INTO cotizacion (id_usuario,  nombre_articulo, descripcion, foto, accion, fecha, visible_admin) VALUES ('$usuarioId', '$nombreArticulo', '$descripcion', '$rutaArchivo', '$accion', '$fechaActual', '$visibleAdmin')";
        } else {
            // No se ha seleccionado una foto, guardar la cotización sin la ruta de la imagen
            $sql = "INSERT INTO cotizacion (id_usuario, nombre_articulo, descripcion, accion) VALUES ('$usuarioId', '$nombreArticulo',  '$descripcion', '$accion', '$visibleAdmin')";
        }

        // Ejecutar la consulta
        if (mysqli_query($conn, $sql)) {
            // Cotización guardada correctamente 
            // Redireccionar a la página de éxito o a donde desees
            header("Location: ../index.php");
            exit;
        } else {
            // Error al guardar la cotización
            echo "Error: " . mysqli_error($conn);
        }

        // Cerrar la conexión
        mysqli_close($conn);
    } else {
        // El usuario no ha iniciado sesión como cliente
        // Redireccionar a la página de inicio de sesión
        header("Location: ../pages/login.php");
        exit;
    }

?>