<?php
    if($peticionAJAX){
        require_once "../core/configApp.php";
    }else{
        require_once "./core/configApp.php";
    }
    class mainModel{
        protected function connect(){
            $enlace = new PDO(SGBD, USER, PASS);
            return $enlace;
        }

        protected function ejecutar_consulta_simple($consulta){
            $respuesta = self::connect()->prepare($consulta);
            $respuesta->execute();
            return $respuesta;
        }

        public function encryption($string){
            $output = FALSE;
            $key = hash('sha256', SECRET_KEY);
            $iv = substr(hash('sha256',SECRET_IV),0,16);
            $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
            $output = base64_encode($output);
            return $output;
        }

        protected function decryption($string){
            $key = hash('sha256', SECRET_KEY);
            $iv = substr(hash('sha256', SECRET_KEY),0,16);
            $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0,$iv);
            return $output;
        }

        protected function generar_codigo_aleatorio($letra, $longitud, $num){
            for ($i=1; $i < $longitud; $i++) { 
                $numero = rand(0,9);
                $letra.= $numero;
            }
            return $letra.$num;
        }

        protected function limpiar_cadena($cadena){
            $cadena = trim($cadena);
            $cadena = stripslashes($cadena);
            $cadena = str_ireplace("<script>", "", $cadena);
            $cadena = str_ireplace("</script>", "", $cadena);
            $cadena = str_ireplace("<script src", "", $cadena);
            $cadena = str_ireplace("<script type=", "", $cadena);
            $cadena = str_ireplace("SELECT * FROM", "", $cadena);
            $cadena = str_ireplace("DELETE FROM", "", $cadena);
            $cadena = str_ireplace("INSERT INTO", "", $cadena);
            $cadena = str_ireplace("--", "", $cadena);
            $cadena = str_ireplace("^", "", $cadena);
            $cadena = str_ireplace("[", "", $cadena);
            $cadena = str_ireplace("]", "", $cadena);
            $cadena = str_ireplace("==", "", $cadena);
            return $cadena;
        }

        protected function sweet_alert($datos){
            if($datos['Alerta'] == "simple"){
                $alerta = "
                    <script>
                        Swal(
                            '".$datos['Titulo']."',
                            '".$datos['Texto']."',
                            '".$datos['Tipo']."'
                        );
                    </script>
                ";
            }elseif($datos['Alerta'] == "recargar"){
                $alerta = "
                    <script>
                        Swal(
                            title: '".$datos['Titulo']."',
                            text: '".$datos['Texto']."',
                            icon: '".$datos['Tipo']."',
                            confirmButtonText: 'Aceptar'
                            }).then(function() {
                                location.reload();
                            });
                        );
                    </script>
                ";
            }elseif($datos['Alerta'] == "limpiar"){
                $alerta = "
                    <script>
                        Swal(
                            title: '".$datos['Titulo']."',
                            text: '".$datos['Texto']."',
                            icon: '".$datos['Tipo']."',
                            confirmButtonText: 'Aceptar'
                            }).then(function() {
                                $('.FormularioAjax')[0].reset();
                            });
                        );
                    </script>
                ";
            }
            return $alerta;
        }
    }
?>