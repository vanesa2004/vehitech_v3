<?php

    include("conexion_bd.php");

    // Obtener el correo del formulario
    $correo = $_POST['correo'];

    // Verificar si el correo ya existe en la base de datos
    $verificarCorreo = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado = $conn->query($verificarCorreo);

    if ($resultado->num_rows > 0) {
        // El correo ya está registrado
        echo "El correo ya está registrado. Por favor, elija otro correo.";
    } else {
        // El correo no está registrado, puedes proceder a insertar los datos
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $num_doc = $_POST['documento'];
        $sexo = $_POST['sexo'];
        $fecha_nacimiento = $_POST['fecha'];
        $telefono = $_POST['telefono'];
        $contraseña = $_POST['contrasena'];
        $rol = 2;

        // Encriptar la contraseña
        $contraseña_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);

        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO usuarios (nombre, apellidos, documento, sexo, fecha_nacimiento, telefono, correo, contrasena, id_rol)
                VALUES ('$nombre', '$apellidos', '$num_doc', '$sexo', '$fecha_nacimiento', '$telefono', '$correo', '$contraseña_encriptada', '$rol')";

        // Ejecutar la consulta y verificar si se ha insertado correctamente
        if ($conn->query($sql) === TRUE) {
            // Define una variable de éxito
            $registroExitoso = true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Redirige de vuelta a la página de registro con la variable de éxito
        header("Location: ../pages/login.php?registroExitoso=" . ($registroExitoso ? "1" : "0"));
    }

    // Cerrar la conexión
    $conn->close();

?>