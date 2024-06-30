<?php
    class Conexion{
        public static function getConexion(){
            try{
               // crear la cadena de conexion
                       $bd="bdsistema";
                       $usuario="root";
                       $pass="123456";
                       $dsn="mysql:host=localhost; dbname=".$bd;
                       $dbh= new PDO($dsn,$usuario,$pass);
                       $dbh->query("SET NAMES 'utf8'");
                       return $dbh;

            }
            catch(PDOException $ex){
                echo "Error:" .$ex->getMessage();
            }
        }
    }
?>