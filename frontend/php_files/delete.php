<?php
    include 'functions.php';

    deleteQuery($_REQUEST["id"]);

    if($_REQUEST){
        Header("Location:index.php");
    };
?>