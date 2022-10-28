<?php 
    include 'functions.php';

    if(isset($_REQUEST["nombre"]) || !$_REQUEST["nombre"]){
        if($_REQUEST){
            Header("Location:index.php?e1");
        };
    };

    createQuery($_REQUEST["nombre"], $_REQUEST["apellido"], $_REQUEST["edad"]);

    if($_REQUEST){
        Header("Location:index.php");
    };
?>
