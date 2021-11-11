<?php 
    if(isset($_SESSION["userLogged"]))
    {
        $userLogged = $_SESSION["userLogged"];
    }
    else
    {
        echo "<script> if(confirm('El usuario esta fuera de la sesion. Debe loguearse en la pagina principal'));";
        echo "window.location.href='../index.php';</script>";
    }
?>