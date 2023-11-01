<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/registro_styles.css">
</head>
<body>

    <div class="container-form">
        <form class="form-registro" action="../php/ProcesarRegistro.php" method="POST">

            <h2>Registro</h2>
    
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="text" name="apellidos" placeholder="Apellidos">
            <input type="text" name="documento" placeholder="Numero documento">
    
            <select name="sexo" id="">
                <option value="" disabled selected>Sexo</option>
                <option value="femenino">Femenino</option>
                <option value="masculino">Masculino</option>
            </select>
    
            <label for="fecha">Fecha de nacimiento:</label>
            <input id="fecha" type="date" name="fecha">
    
            <input type="tel" name="telefono" placeholder="Numero telefono">
            <input type="email" name="correo" placeholder="Correo">
            <input type="password" name="contrasena" placeholder="Contraseña">
    
            <button class="btn-registro">Registrarme</button>
            
        </form>
    </div>


</body>
</html>