<?php
    include 'functions.php';

    if(!$_REQUEST["id"]){
        Header("Location:index.php?mensaje= No se ingresó el id. >");
    }

    if(!$_REQUEST["nombre"]){
        Header("Location:index.php?mensaje= 'No se ingresó Nombre.' >");
    }

    if(!$_REQUEST["apellido"]){
        Header("Location:index.php?mensaje= 'No se ingresó Apellido.' >");
    }

    if(!$_REQUEST["edad"]){
        Header("Location:index.php?mensaje= 'No se ingresó Edad.' >");
    }

    updateQuery($_REQUEST["id"], $_REQUEST["nombre"], $_REQUEST["apellido"], $_REQUEST["edad"]);

    if($_REQUEST){
        Header("Location:index.php?mensaje= Prueba editada exitosamente. >");
    };

?>