<?php
    session_start();
    include("conexion_bd.php");

    // Obtener los datos del formulario
    $correo = $_POST['email'];
    $contraseña = $_POST['password'];

    // Consulta SQL para obtener el usuario por su correo
    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' LIMIT 1";
    $resultado = $conn->query($sql);

    if ($resultado !== false && $resultado->num_rows > 0) {
        // El usuario existe en la tabla de usuarios
        $usuario = $resultado->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($contraseña, $usuario['contraseña'])) {
            if ($usuario['id_rol'] == 1) {
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['usuario_rol'] = 'administrador';
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['isLoggedIn'] = true;
                header('Location: ../pages/admin.php');
                exit();
            } elseif ($usuario['id_rol'] == 2) {
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['usuario_rol'] = 'cliente';
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['apellidos'] = $usuario['apellidos'];
                $_SESSION['documento'] = $usuario['documento'];
                $_SESSION['sexo'] = $usuario['sexo'];
                $_SESSION['fecha_nacimiento'] = $usuario['fecha_nacimiento'];
                $_SESSION['telefono'] = $usuario['telefono'];
                $_SESSION['correo'] = $usuario['correo'];
                $_SESSION['isLoggedIn'] = true;
                header('Location: ../index.php');
                exit();
            }
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta";
        }
    } else {
        // El usuario no existe
        echo "Usuario no encontrado";
    }

    // Cerrar la conexión
    $conn->close();
?>