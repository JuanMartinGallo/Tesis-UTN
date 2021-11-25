<?php

  $target_dir = "../uploaded_files/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      $uploadOk = 0;
    }
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Lo sentimos, el archivo ya existe en el sistema.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Lo sentimos, tu archivo es demasiado pesado.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($fileType != "doc" && $fileType != "docx") {
    echo "Lo sentimos, solo los archivos de extension .doc o .docx son permitidos.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Lo sentimos, tu archivo no pudo ser subido.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "El archivo ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " ha sido subido correctamente.";
      require_once ('jobOffer-list.php');
    } else {
      echo "Lo sentimos, hubo un error mientras se subia tu archivo.";
    }
  }
?>