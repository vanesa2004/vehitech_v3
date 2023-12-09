<?php
  session_start();

  // Verificar si la sesión está iniciada y si hay un nombre de usuario almacenado
  if (!isset($_SESSION['nombre'])) {
    // El usuario no ha iniciado sesión, redirige a la página de inicio de sesión o muestra un mensaje de error
    header("Location: login.php"); 
    exit();
  }

  // Ahora puedes continuar con el contenido de la página
  $nombreAdmin = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrador</title>

  <!--Estilos de la pagina administrador -->
  <link rel="stylesheet" href="../css/admin_styles.css">

</head>
<body>

  <header>

    <img src="../img/logo.png" alt="">


    <div class="container-header">

      <div class="name">
        <p><?php echo isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] ? $nombreAdmin : ''; ?></p>
        <a href="../php/CerrarSesion.php">Cerrar sesión<img src="../img/sing-off.svg" alt=""></a>
      </div>

      <!-- Menú de pestañas -->
      <div class="tablinks-container">
        <button class="tablinks" onclick="openTab(event, 'notificaciones')">Notificaciones</button>
        <button class="tablinks" onclick="openTab(event, 'articulos')">Artículos</button>
        <button class="tablinks" onclick="openTab(event, 'categorias')">Categorías</button>
      </div>
        
    </div>

  </header>

  <!-- Contenido de las pestañas -->
	
	<div id="notificaciones" class="tab active"> <!-- contenido de las notificaciones de la compraventa -->

		<h2>Notificaciones de cotizacion</h2>

    <div class="container-cotizacion">

      <?php
      
        include("../php/VerCotizacionesAdmin.php");
      
      ?>

    </div>
	
	</div> <!-- termina notificaciones de la compraventa -->

  <div id="articulos" class="tab"> <!-- contenido de los articulos de la compraventa -->

    <h2>Articulos de la compraventa</h2>

    <a class="agregar-btn" href="./AdminAgregarArticulo.php">Agregar nuevo artículo</a>

    <div class="container-articulos">

      <?php
        include("../php/VerArticulosAdmin.php");
      ?>

    </div>
		
	</div> <!-- cierre etiqueta de los articulos de la compraventa -->

  <div id="categorias" class="tab"> <!-- contenido de las categorias de la compraventa  -->

    <h2>Categorías</h2>

    <a class="btn-categoria" href="./AdminAgregarCategoria.php" class="btn">Agregar categoría</a>

    <div class="container-categorias">

      <?php
      
        include("../php/CategoriasAdm.php");
      
      ?>

    </div>

    

  </div> <!-- cierre de la etiqueta del contenido de catrgorias -->

  <!-- escript de la navegacion de pestañas -->
  <script src="../js/NavegacionPestanas.js"></script>

  <!-- escript para eliminar la cotizacion que ha realizado algun cliente -->
  <script src="../js/DescartarCotizacionAdm.js"></script>
    
</body>
</html>