<?php 

    if(isset($_SESSION['userLogged']) == NULL)
    {
        echo "<script> if(confirm('El usuario esta fuera de la sesion. Debe loguearse en la pagina principal'));";
        echo "window.location = 'index.php';
        </script>";
    }
    else
    {
        
    }

?>