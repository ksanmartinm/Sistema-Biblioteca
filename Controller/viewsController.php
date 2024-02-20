<?php
    require_once "./Model/viewsModel.php";
    class viewsController extends viewsModelo{
        public function obtener_plantilla_controller(){
            return require_once "./View/plantilla.php";
        }

        public function obtener_views_controller(){
            if(isset($_GET['views'])){
                $ruta = explode("/", $_GET['views']);
                $respuesta = viewsModelo::obtener_views_model($ruta[0]);
            }else{
                $respuesta = "login";
            }
            return $respuesta;
        }
    }