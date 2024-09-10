<?php 

    namespace Controllers;
    
    
    class LoginController {
        public static function login(){
            echo "Desde Login";
        }

        public static function logout(){
            echo "Desde Logout";
        }

        public static function olvide(){
            echo "Desde Olvide";
        }

        public static function recuperar(){
            echo "Desde Recuperar";
        }

        public static function crear(){
            echo "Desde Crear Cuenta";
        }
    }