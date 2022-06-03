<?php
class Database {
    private $hostname="localhost";
    private $database = "tienda_online";
    private $username = "root";
    private $dbpassword ="";
    private $dbcharset="utf8";

    

    public function conectar()
    {
        try{
            $conexion="mysql:host=".$this->hostname.";dbname=".$this->database.";username=".$this->username.";password=".$this->dbpassword.";charset=".$this->dbcharset;
            $options=[
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES=>false
            ];
            $pdo=new PDO($conexion,$this->username,$this->dbpassword,$options);
            return $pdo;
        }catch(PDOException $e){
            echo 'error de conexion :'.$e->getMessage();
            exit;
        }

    }
}
?>