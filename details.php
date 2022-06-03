<?php
require 'config/config.php';
require 'config/database.php';
$db =new Database();
$con= $db->conectar();

$id =isset($_GET['id']) ? $_GET['id']: '';
$token =isset($_GET['token']) ? $_GET['token']:'';

if($id== ''||  $token='')
{
    echo 'error al procesar la peticion';
    exit;
}else{
    $token_tmp= hash_hmac('sha1', $id, KEY_TOKEN);

    if($token == $token_tmp){
        $sql= $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
        $sql->execute([$id]);
    if($sql->fetchColumn() > 0)
  {
    $sql= $con->prepare("SELECT nombre, descripcion,precio FROM productos WHERE id=? AND activo=1 LIMIT 1");
    $sql->execute([$id]);
    $row=$sql->fetch(PDO::FETCH_ASSOC);
    $nombre=$row['nombre'];
    $descripcion= $row['descripcion'];
    $precio= $row['precio'];

  }
}else{
    echo 'error al procesar la peticion';
    exit;
     }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tienda online</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet">
</head>
<body>
<header>
  <div class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <div class="container">
      <a href="#" class="navbar-brand ">
        
        <strong>Crare</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" 
      aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse"id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                  <a href="#" class="nav-link active">catalogo</a>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link ">contacto</a>
              </li>
          </ul>
          <a href="carrito.php" class="btn btn-primary">carrito</a>
      </div>
    </div>
</div>
</header>
<!--contenido-->
<main>
  <div class="container">
    <div class="row">
        <div class="col-md-6 order-md-1">
              <img src="imagenes/productos/1/principal.jpeg">
         </div>
         <div class="col-md-6 order-md-2">
<h2><?php echo $nombre; ?></h2>
<h2><?php echo MONEDA . number_format($precio,2,'.',',');?></h2>
<p class="lead">
    <?php echo $descripcion;?>

</p>
<div class="d-grid gap-3 col-10 mx-auto">
    <button class="btn btn-primary"type="button">comprar ahora</button>
    <button class="btn btn-outline-primary"type="button">agregar al carrito</button>


</div>

         </div>

</div>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
 crossorigin="anonymous"></script>

</body>
</html>