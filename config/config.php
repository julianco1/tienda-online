<?php

define("CLIENT_ID","ASNhNk7HHYfgXaiknC_sKu1z1sAHvxnr8kf0LK6VEoWtadVc806XNWKFcmejF7Ar7F2JBgN66KcoZqqe");
define("CURRENCY", "MXN");
define("KEY_TOKEN","APR.wqc-354*");
define("MONEDA","$");

session_start();
$num_cart=0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart= count($_SESSION['carrito']['productos']);
}

?>