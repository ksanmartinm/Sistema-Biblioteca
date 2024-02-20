<?php
    class viewsModelo{
        
        protected function obtener_views_model($views){
            $listaBlanca = ["adminList","adminSearch","admin",
                            "book","bookConfig","bookInfo",
                            "catalog","category","categoryList",
                            "client","clienteList","clienteSearch",
                            "company","companyList","home",
                            "myAccount","myData","provider",
                            "providerList","search"];
            if (in_array($views, $listaBlanca)) {
                if(is_file("./View/content/".$views."-view.php")){
                    $contenido = "./View/content/".$views."-view.php";
                }else{
                    $contenido = "login";
                }
            }elseif($views == "login"){
                $contenido = "login";
            }elseif($views == "index"){
                $contenido = "login";
            }else{
                $contenido = "404";
            }

            return $contenido;
        }

    }