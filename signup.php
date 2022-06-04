<?php

require 'config/config.php';
require 'config/database.php';
$db =new Database();
$con= $db->conectar();

$sql= $con->prepare("SELECT id,nombre,precio FROM productos WHERE activo=1");
$sql->execute();
$resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

//session_destroy(); //para eliminar todo lo de los datos

//print_r($_SESSION);
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
    <a href="#" class="navbar-brand d-flex align-items-center">
        <svg xmlns="" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox=""><path d=""></path></svg>
        <img src="imagenes/logo arte pop.png" class="navbar-brand d-flex align-items-center"width="80" height="100">
      </a>
      <a href="#" class="navbar-brand ">
        
        <strong>Crare</strong>
        
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" 
      aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse"id="navbarHeader">
          
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
  
      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Iniciar sesion
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inicio de sesion</h5>
        <div class="modal-body">
                            <p type="nombre">
                                <input type="text" placeholder="escriba su nombre y apellido aqui" required></input>
                            </p>
                            <p type="correo:">
                              <input type="text" placeholder="escriba su correo" required></input>
                            </p>
                            <p type="password:">
                              <input type="text"placeholder="escriba su contraseña" required></input>
                            </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Iniciar sesion</button>
      </div>
    </div>
  </div>
</div>
     
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
  Registrarse
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrarse</h5>
        <div class="modal-body">
                            <p type="nombre">
                                <input type="text" placeholder="escriba su nombre y apellido aqui" required></input>
                            </p>
                            <p type="correo:">
                              <input type="text" placeholder="escriba su correo" required></input>
                            </p>
                            <p type="password:">
                              <input type="text"placeholder="escriba su contraseña" required></input>
                            </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Registro</button>
      </div>
    </div>
  </div>
</div>
</header>

<header>
  <div class="navbar navbar-expand-lg navbar-light bg-primary ">
    <div class="container">
      
    
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" 
      aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse"id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a href=# class="nav-link active">inicio</a>
            </li>
              <li class="nav-item">
                  <a href="#" class="nav-link active">catalogo</a>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link ">contacto</a>
              </li>
          </ul>
          <a href="checkout.php" class="btn btn-secondary">
              carrito <span id="num_cart" class="badge bg-dark"><?php echo $num_cart; ?></span>
            </a>
      </div>
    </div>
</div>
</header>

<main>
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php foreach($resultado as $row) {?>
        <div class="col">
          <div class="card shadow-sm">
            <?php
             $id= $row['id'];
             $imagen="imagenes/productos/".$id."/principal.jpeg";
             if(!file_exists($imagen))
             {
               $imagen="imagenes/no-photo.jpg";
             }
            ?>
              <img src="<?php echo $imagen; ?>">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['nombre'];?></h5>
              <p class="card-text"><?php echo number_format($row['precio'],2,'.',',');?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="details.php?id=<?php echo $row['id'];?>&token=<?php echo 
                  hash_hmac('sha1',$row['id'],KEY_TOKEN);?> "class="btn
                   btn-primary">detalles</a>
                </div>
                <button class="btn btn-outline-secondary"type="button" onclick="addProducto
                (<?php echo $row['id']; ?>,'<?php echo hash_hmac('sha1',$row['id'],
                KEY_TOKEN); ?>')">Agregar al carrito</button>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
 crossorigin="anonymous"></script>
 <script>
     function addProducto(id, token)
     {
         let url='clases/carrito.php';
         let formData= new FormData()
         formData.append('id',id)
         formData.append('token',token)
         fetch(url,
         {
             method: 'POST',
             body: formData,
             mode:'cors'
         }).then(response => response.json())
         .then(data =>{
             if(data.ok){
                 let elemento=document.getElementById("num_cart")
                 elemento.innerHTML=data.numero
             }
         })
     }
     </script>

</body>
<footer class="mastfoot mt-auto">
    <div class="align-items:center">
      <p>Cover template for <a href="https://getbootstrap.com/">julian colmenares</a>, by <a href="view-source:https://getbootstrap.com/docs/4.6/examples/cover/#">@julian</a>.</p>
    </div>
</div>
  </footer>
</html>