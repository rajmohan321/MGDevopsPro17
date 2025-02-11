<?php
class Session{
     
        public static function start(){
            session_start();
        }
        public static function destroy(){
            session_destroy();
        }
        public static function unset(){
            session_unset();
        }
        public static function reset(){
            session_reset();
        }
        public static function set($key,$value){
            $_SESSION[$key] = $value;
        }
        public static function isset($key){
            return isset($_SESSION[$key]);
        }
    }