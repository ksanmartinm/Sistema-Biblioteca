<?php 
    require_once "core/configGeneral.php";
    require_once "Controller/viewsController.php";

    $plantilla = new viewsController();
    $plantilla->obtener_plantilla_controller();