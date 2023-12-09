function openTab(evt, tabName) {
    // Ocultar todas las pestañas
    var tabs = document.getElementsByClassName("tab");
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].style.display = "none";
    }
    // Remover la clase "active" de todos los botones de pestañas
    var tablinks = document.getElementsByClassName("tablinks");
    for (var i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    // Mostrar la pestaña seleccionada y agregar la clase "active" al botón de pestaña correspondiente
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
  }