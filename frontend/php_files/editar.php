<?php 

    include 'functions.php';

    $id = $_REQUEST["id"];

    $result = readOneQuery($id);

    $prueba = $result['data'][0];

    $nombre = $prueba["nombre"];
    $apellido = $prueba["apellido"];
    $edad = $prueba["edad"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Prueba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>    
</head>
<body>
    <div class="card" style="Width 25%">
        <h3>Crear nueva Prueba</h3>
        <form id = "create-form" action="update.php">
            <div class="form-row m">
                <div class="col">
                    <input type="number" name="id" value ="<?= $id ?>" class="form-control mb-2" placeholder="Id">
                </div>
                <div class="col">
                    <input type="text" name="nombre" value ="<?= $nombre ?>" class="form-control mb-2" placeholder="Nombres">
                </div>
                <div class="col">
                    <input type="text" name="apellido" value ="<?= $apellido ?>" class="form-control mb-2" placeholder="Apellidos">
                </div>
                <div class="col">
                    <input type="number" name="edad" value ="<?= $edad ?>" class="form-control mb-2" placeholder="Edad">
                </div>
                <Button type="submit" class="btn btn-primary">Editar Prueba</button>
            </div>
        </form>
    </div>
</body>
