<?php

include ("../../php/session/validateSession.php");

?>
<html lang="en">
<?php
    include 'templates/head.php'; 
?>
<body>   
    
<?php
    include 'templates/templateMenu.php'; 
?>

<h1>Show FORO</h1>

<!-- Div para esconder el id del foro -->
<div id="id_foro_div"  class="d-none">
    <p id="id_foro"></p>
</div>

<div class="foro">   
    <div id="div_foro_title">
        <h2 class="title_foro" id="foro_name">
            <!-- Title of the foro -->
        </h2>
        
    </div>
    <div id="div_foro_description">
        <h4 class="card-text" id="foro_description">
            <!-- Description of the foro -->
        </h4>    
    </div>
    <div id="div_foro_league">
        <h5 class="card-text" id="foro_league">
            <!-- League of the foro -->
        </h5>
    </div>
    <div id="div_img_content">
        <!-- Image of the foro -->
        <img src="" alt="..." class="card-img card-img-top" id="foro_image">    
    </div>

    <!-- Deactivate and modify foro buttons (Just for admin users) -->
    <?php
        if($_SESSION['admin']) {
            echo "<button id='deactivate_foro' type='button' class='btn btn-primary' data-toggle='modal' data-target='#confirmQuestion'>Desactivar Foro</button>";
            echo "<button id='modify_foro' type='button' class='btn btn-primary' data-toggle='modal' data-target='#modifyForoModal'>Modificar Foro</button>";
        }
    ?>
</div>

<?php
    include 'modals/modal_modifyForo.php'; 
    include 'modals/modal_alerts.php';
?>

<!-- COMMENT SECTIONS -->

<h3 class="mt-3">Comment Section</h3>

<div class="text-right">
    <button id='add_comment_btn' type='button' class='btn btn-primary' title="Añadir mensaje"><i class="las la-plus-circle la-2x"></i></button>
    <button id="filter-zone"  type='button' class='btn btn-primary' title="Filtrar"><i class="las la-filter la-2x"></i></button>    
</div>

<section id="comment-section">
    <div id="content-comment">
        <!-- Comments of the foro -->
    </div>
</section>

<script src="../../js/jquery-3.7.1.min.js"></script>

<!-- JavaScript de Bootstrap (jQuery es requerido) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<!-- JS -->
<script src="../../js/foro/update/update.js"></script>
<script src="../../js/foro/selects/fill_selects.js"></script>
<script src="../../js/foro/validation/validations.js"></script>
<script src="../../js/foro/getForo.js"></script>
<script src="../../js/foro/manageForo.js"></script>
<script src="../../js/foro/manageComment.js"></script>

</body>
</html>