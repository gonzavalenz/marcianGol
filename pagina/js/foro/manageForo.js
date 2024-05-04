function deactivateForo(idForo) {
	return new Promise(function (resolve, reject) {
		$.ajax({
            url: "../../php/foro/deactivateForo.php", // URL del script PHP que manejará la solicitud
            type: "POST", // Método de envío de la solicitud
            data: {id_foro: idForo}, // Datos a enviar
            success: function(response) {
                console.log("Desactivado: " + idForo);
            },
            error: function(xhr, status, error) {
                // Acciones a realizar en caso de error
                console.log("Error en la solicitud AJAX:", error);
            }
        });
	});
}

$(document).ready(function () {

    var deactivateBtn = document.getElementById("confirmBtn");
    // Get the params from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const idForo = urlParams.get('id');

    console.log(idForo);

    deactivateBtn.addEventListener("click", function() {
        deactivateForo(idForo);
    });
}); 