<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login_styles.css">
</head>
<body>

    <form class="frm-login" action="../php/ProcesarLogin.php" method="post">

        <h2>Iniciar sesión</h2>

        <input type="text" name="email" placeholder="Correo">
        <input type="password" name="password" placeholder="Contraseña">

        <p>¿No esta registrado?<a href="./registro.php">Registrate aqui</a></p>

        <button class="log-in">Inciar sesión</button>

        <br>

        <!-- Div para mostrar el mensaje de registro exitoso -->
        <div id="registroExitoso" style="display: none; color: green;">
            Registro exitoso, ya puedes iniciar sesión.
        </div>

    </form>
    
</body>
</html>