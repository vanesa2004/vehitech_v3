<?php

  session_start();

  // Verificar si la sesión está iniciada y si hay un nombre de usuario almacenado
  if (isset($_SESSION['nombre'])) {
    $nombreUsuario = $_SESSION['nombre'];
  }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vehitech</title>

  <!--Estilos del index -->
  <link rel="stylesheet" href="./css/index_styles.css">

  <!--Estilos de la pestaña inicio-->
  <link rel="stylesheet" href="./css/inicio_styles.css">

  <!-- estilos del slider -->
  <link rel="stylesheet" href="./css/slider_styles.css">
  
  <!-- estilos de los articulos -->
  <link rel="stylesheet" href="./css/articulos_styles.css">

  <!-- estilos de la pestaña  cotizar -->
  <link rel="stylesheet" href="./css/cotizar_styles.css">

    <!-- estilos de la pestaña  cotizar -->
    <link rel="stylesheet" href="./css/MiCuenta_styles.css">

</head>
<body>

    <header> <!--en la otra es un nav -->
        
        <img src="img/logo.png" alt="">

        <div class="container-general">

            <div class="btn-search">
                <form action="" method="get">
                    <input type="search" id="search-input" placeholder="Buscar artículos" name="q">
                    <button class="btn-busqueda"><img src="img/search.svg" alt="Buscar"></button>
                </form>
    
                <div class="menu">
                    <img src="./img/menu.svg" alt=""> <!-- falta incluir el icono de menu para la version resposive de movil -->
                </div>
    
                <div class="btn">
                    <a href="./pages/carrito.php">Carrito</a>
                    <a href="./pages/login.php">Iniciar sesión</a>
                    <a href="./pages/registro.php">Registrarse</a>
                    <p class="nombre"><?php echo isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] ? $nombreUsuario : ''; ?></p>
                </div>

            </div>
                
            <!-- Menú de pestañas -->
            <div class="tablinks-container"> <!-- en la otra se llama "container-tabs" y con a -->
            <button class="tablinks" onclick="openTab(event, 'inicio')">Inicio</button>
            <button class="tablinks" onclick="openTab(event, 'articulos')">Artículos</button>
            <button class="tablinks" onclick="openTab(event, 'cotizar')">Cotizar</button>
            <?php if (isset($_SESSION['nombre'])) { ?>
                <button class="tablinks" onclick="openTab(event, 'micuenta')">Mi cuenta</button>
            <?php } ?>

        </div>

    </header>

  <!-- Contenido de las pestañas -->
	<div id="inicio" class="tab active">

        <div class="container-aside">

            <aside>

                <h2>Nuevos artículos</h2>

                <div class="new-article">

                    <?php
                    
                        include("php/UltimosArticulos.php");

                    ?>

                </div>

            </aside>

            <main class="main-slider">

                <div class="info-usuario">

                    <h1>Cotiza tu <br><br> moto, carro, <br><br> computador, celular <br><br> electrodomésticos <br><br> y demas.</h1>

                </div>

                <!--inicio slider-->
                <div class="slider">
                    <div class="slides">
                        <!--botones de radio inicio-->
                        <input type="radio" name="radio-btn" id="radio1">
                        <input type="radio" name="radio-btn" id="radio2">
                        <input type="radio" name="radio-btn" id="radio3">
                        <input type="radio" name="radio-btn" id="radio4">
                        <input type="radio" name="radio-btn" id="radio5">
                        <!--botones de radio final-->

                        <!--inicio imagenes slider-->
                        <div class="slide first">
                            <img src="./img/moto.jpg" alt="">
                        </div>

                        <div class="slide">
                            <img src="./img/sedan-plateado.jpg" alt="">
                        </div>

                        <div class="slide">
                            <img src="./img/portatil.jpg" alt="">
                        </div>

                        <div class="slide"> 
                            <img src="./img/celular.jpg" alt="">
                        </div>

                        <div class="slide">
                            <img src="./img/electrodomesticos.jpg" alt="">
                        </div>
                        <!--final imagenes slider-->

                        <!--inicio de navegacion automatica-->
                        <div class="navigation-auto">
                            <div class="auto-btn1"></div>
                            <div class="auto-btn2"></div>
                            <div class="auto-btn3"></div>
                            <div class="auto-btn4"></div>
                            <div class="auto-btn5"></div>
                        </div>
                        <!--final de navegacion automatica-->
                    </div>
                    <!--inicio de navegacion manual-->
                    <div class="navigation-manual">
                        <label for="radio1" class="manual-btn"></label>
                        <label for="radio2" class="manual-btn"></label>
                        <label for="radio3" class="manual-btn"></label>
                        <label for="radio4" class="manual-btn"></label>
                        <label for="radio5" class="manual-btn"></label>
                    </div>
                    <!--final de navegacion manual-->
                </div>
                <!--final slider-->

            </main>

        </div>

        <main class="main-categorias">

            <h2>Nuestras categorías</h2>

            <div class="categorias">

                <?php
                    include("./php/MostrarCategoriasCliente.php");
                ?>
                
            </div>

        </main>

	</div>
	
	<div id="articulos" class="tab">

        <?php
            include("./php/MostrarArticulosCliente.php");
        ?>
                 
    </div>

    <div id="cotizar" class="tab">

        <div class="container-form">
            <form class="form-cotizacion" action="./php/CotizacionCliente.php" method="POST"  enctype="multipart/form-data">

                <h2>Cotizar artículo</h2>

                <input type="text" name="nombrearticulo" placeholder="Nombre artículo" require>

                <textarea name="descripcionarticulo" placeholder="Agrega una descripcion detallada de tu artículo" id="" cols="30" rows="10" require></textarea>

                <label for="archivo">Agrega una foto de tu articulo:</label>
                <input type="file" id="archivo" name="archivo" require>

                <div class="cot-accion">
                    <label for="accion">¿Qué desea hacer con su artículo?</label><br><br>
                    <input type="radio" id="vender" name="accion" value="vender">
                    <label for="vender">Vender</label><br>
                    <input type="radio" id="empenar" name="accion" value="empeñar">
                    <label for="empenar">Empeñar</label><br><br>
                </div>

                <button class="btn-cotizar">Cotizar</button>
                
            </form>
    </div>

	</div>

    <div id="micuenta" class="tab"> <!-- contenido de mi cuenta --> 

        <div class="container-cuenta">

            <aside>
                <div class="container-micuenta">
    
                    <div class="title-misdatos">
                        <h3>Mis datos</h3>
                        <a class="sing-off" href="#">Cerrar sesión</a>
                    </div>
    
                    <div class="container-datos">
    
                        <div class="datos">
                            <div class="nom">
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" value="<?php echo $_SESSION['nombre']; ?>">

                                <label for="documento">Número de documento:</label>
                                <input type="text" id="documento" name="documento" value="<?php echo $_SESSION['documento']; ?>">

                                <label for="fecha-nacimiento">Fecha de nacimiento:</label>
                                <input type="text" id="fecha-nacimiento" name="fecha_nacimiento" value="<?php echo isset($_SESSION['fecha_nacimiento']) ? $_SESSION['fecha_nacimiento'] : ''; ?>">

                                <label for="correo">Correo electrónico:</label>
                                <input type="email" id="correo" name="correo" value="<?php echo $_SESSION['correo']; ?>">
                            </div>
    
                            <div class="ape">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" id="apellidos" name="apellidos" value="<?php echo $_SESSION['apellidos']; ?>">

                                <label for="sexo">Sexo:</label>
                                <input type="text" id="sexo" name="sexo" value="<?php echo $_SESSION['sexo']; ?>">

                                <label for="telefono">Número de teléfono:</label>
                                <input type="tel" id="telefono" name="telefono" value="<?php echo $_SESSION['telefono']; ?>">
                            </div>
                        </div>
    
                    </div>
    
                </div>
    
                <div class="linea"></div>
        
                <div class="container-miscompras">
    
                    <div class="title-miscompras"> 
                        <h2>Mis compras</h2>
                        <a class="cerrar-sesion" href="./php/CerrarSesion.php">Cerrar sesión</a>
                    </div>
    
                    <div class="container-article">
                        <article>
    
                            <div class="info-pedido">
                                <p>Pedido 01</p>
                                <p>Fecha de compra: 23</p>
                                <p>Total</p>
                            </div>
        
                            <img src="./img/negocio.jpg" alt="imagen">
                            <p>Articulo 1</p>
        
                        </article>

                    </div>
        
                </div>
            </aside>
    
            <div class="container-miscotizaciones">
    
                <h2>Mis cotizaciones</h2>
    
                <div class="info-cotizacion">

                    <?php
                        include("./php/HistorialCotizaciones.php");
                    ?>
    
                </div>
    
            </div>
    
        </div>

    </div> <!-- cierra contenido de mi cuenta -->

    <footer>
        <div class="atencion-contacto">
            <div class="atencion">
                <h5>Atención presencial</h5>
                <p>8:00 AM a 11:30 Am</p>
                <p>2:00 PM a 5:00 PM</p>
            </div>

            <div class="contacto">
                <h5>Contacto</h5>
                <p>3108020494</p>
                <p>vehitech@gmail.com</p>
                <p>Florencia Caquetá</p>
                <p></p>
            </div>
        </div>

        <div class="cntnr-rds">
            <h5>Redes Sociales</h5>
            <div class="img-redes">
                <a href="https://es-la.facebook.com/"><img src="./img/facebook_.png" alt="facebook"></a>
                <a href="https://www.instagram.com/"><img src="./img/instagram.png" alt="instagram"></a>
                <a href="https://facebook.comweb.whatsapp.com"><img src="./img/watsap.png" alt="whatsapp"></a>
            </div>
        </div>
    </footer>

    <!-- enlace a script de navegacion -->
  <script src="./js/NavegacionPestanas.js"></script>

    <!-- script del slider -->
    <script src="./js/slider.js"></script>

    <!-- escript para redireccion a el login si el usuario no ha iniciado sesion para agregar al carrito -->
    <script src="./js/SesionCarrito.js"></script>

    <script src="./js/AgregarArticulo.js"></script>
    
    
</body>
</html>