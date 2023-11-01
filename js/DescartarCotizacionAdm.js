// Obtener todos los botones de "Descartar" por su clase
const botonesDescartar = document.querySelectorAll('.descartar-cotizacion');

// Agregar un evento de clic a cada botón de "Descartar"
botonesDescartar.forEach(boton => {
    boton.addEventListener('click', function() {
        const cotizacionId = this.getAttribute('data-id');
        if (confirm('¿Estás seguro de que deseas descartar esta cotización?')) {
            // Realizar una solicitud AJAX para marcar la cotización como "descartada"
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../php/DescartarCotizacionAdm.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Actualizar la página o realizar otras acciones necesarias después de marcar como "descartada"
                    alert(xhr.responseText);
                    // Recargar la página para reflejar los cambios
                    window.location.reload();
                }
            };
            xhr.send(`id=${cotizacionId}`);
        }
    });
});