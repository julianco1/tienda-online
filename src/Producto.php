<?php

namespace tecnologias;

class producto
{
    private $config;
    private $cn=null;

    public function __construct()
    {
          $this->config= parse_ini_file(__DIR__.'/../config.ini'); 
          $this->cn=new \PDO($this->config['dns'],$this->config['usuario'],$this->config['clave'],array(
              \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
          ));
    }

    public function registrar($_params)
    {
        $sql="INSERT INTO `productos`(`nombre_producto`, `descripcion`, `foto`, `precio`, `categoria_id`, `fecha`) VALUES (:nombre_producto, :descripcion, :foto, :precio, :categoria_id, :fecha)";
        $resultado=$this->cn->prepare($sql);

        $_array=array(
            ":titulo"=>$_params['titulo'],
            ":descripcion"=>$_params['descripcion'],
            ":foto"=>$_params['foto'],
            ":categoria_id"=>$_params['categoria_id'],
            ":fecha"=>$_params['fecha'],
        );
        if($resultado->execute($_array))
        return true;

        return false;
    }
    public function actualizar($_params)
    {
        $sql="UPDATE `productos` SET `nombre_producto`=:nombre_producto,`descripcion`=:descripcion,`foto`=:foto,`precio`=:precio,`categoria_id`=:categoria_id,`fecha`=:fecha WHERE `id`=:id";
        $resultado=$this->cn->prepare($sql);

        $_array=array(
            ":nombre_producto"=>$_params['nombre_producto'],
            ":descripcion"=>$_params['descripcion'],
            ":foto"=>$_params['foto'],
            ":categoria_id"=>$_params['categoria_id'],
            ":fecha"=>$_params['fecha'],
            ":id"=>$_params['id']
        );
        if($resultado->execute($_array))
        return true;

        return false;
    }
    public function eliminar($id)
    {
        $sql="DELETE FROM `productos` WHERE `id`=:id";
        $resultado=$this->cn->prepare($sql);

        $_array=array(
            ":id"=>$_params['id']
        );
        if($resultado->execute($_array))
        return true;

        return false;
    }
    public function mostrar()
    {
        $sql="SELECT productos.id,nombre_producto,descripcion,foto,nombre,precio,fecha,estado* FROM productos
        
        INNER JOIN categoria
        ON productos.categoria_id=categoria.id ORDER BY productos.id DESC";
        $resultado=$this->cn->prepare($sql);

        if($resultado->execute())
        return $resultado->fetchAll();

        return false;
    }
    public function mostrarPorId($id)
    {
        $sql="SELECT *FROM `productos`WHERE`id`=:id";
        $resultado=$this->cn->prepare($sql);
        $_array=array(
            ":id"=>$_params['id']
        );

        if($resultado->execute($_array))
        return $resultado->fetch();

        return false;
    }
}