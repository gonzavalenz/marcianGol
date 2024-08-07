<?php

include ("../../php/session/validateSession.php");
include ("../../php/session/validateAdmin.php");

?>
<!DOCTYPE html>
<html lang="en">  
    
    <?php
        include 'templates/head.php'; 
    ?>
<body>
    
    <?php
        include ("templates/templateMenu.php");
    ?>

<h1>Crear Foro</h1>

<!-- Formulario de modificación sin modal -->
<div class="container">
    
    <form id="modificarForoForm">
        <br>
        <div class="form-group">
            <label for="nameCreateForo" class="form-label h5 font-weight-bold">Nombre del Foro</label>
            <input type="text" class="form-control" id="nameCreateForo" placeholder="Nombre del Foro">
        </div>
        <br>
        <div class="form-group">
            <label for="descriptionCreateForo" class="form-label h5 font-weight-bold">Descripción del Foro</label>
            <textarea class="form-control" id="descriptionCreateForo" rows="3" placeholder="Descripción del Foro"></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="imageCreateForo" class="form-label h5 font-weight-bold">Equipo del Foro</label>
            <select class="form-control mt-1 mb-1" id="imageCreateForo">
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="leagueCreateForo" class="form-label h5 font-weight-bold">Liga del Foro</label>
            <select class="form-control mt-1 mb-4" id="leagueCreateForo">
            </select>
        </div>
        <button type="button" class="btn btn-primary" id="createForoButton">Confirmar</button>
        <button type="button" class="btn btn-primary" id="cleanCreateFormButton">Limpiar</button>
    </form>
</div>

<?php
    include 'templates/footer.php'; 
    include 'modals/modal_alerts.php'; 
?>

<!-- JavaScript de Bootstrap (jQuery es requerido) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<!-- JS -->
<script src="../../js/foro/createForo.js"></script>


</body>
</html>