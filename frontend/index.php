<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>    
</head>
<body>    
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <div class="container mt-5">
        <div class="row" > 
            <div class="col-md-3"> 
                <h3>Crear nueva Prueba</h3>
                <form id = "create-form" action="">
                    <div class="form-row">
                        <div class="col">
                            <input type="text" name="nombre" class="form-control mb-2" id = "nombre" placeholder="Nombres">
                        </div>
                        <div class="col">
                            <input type="text" name="apellido" class="form-control mb-2" id = "apellido" placeholder="Apellidos">
                        </div>
                        <div class="col">
                            <input type="number" name="edad" class="form-control mb-2 " id = "edad" placeholder="Edad">
                        </div>

                        <Button type="button"  id="btn_registrar_prueba" class="btn btn-primary">Registrar Prueba</button>
                    </div>
                </form>
            </div>

            <div class="col-md-8" style="max-widht:500px" >
            <h3> Mostrando pruebas </h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>

                    <tbody id="t-body">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="formulario_editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Prueba</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">

                            <form id = "edit-form" action="">

                                <div class="form-row">
                                    <div class="col">
                                        <input type="number" name="nombre" class="form-control mb-2" id = "id_editar" placeholder="ID" readonly="readonly">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="nombre" class="form-control mb-2" id = "nombre_editar" placeholder="Nombres">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="apellido" class="form-control mb-2" id = "apellido_editar" placeholder="Apellidos">
                                    </div>
                                    <div class="col">
                                        <input type="number" name="edad" class="form-control mb-2" id = "edad_editar" placeholder="Edad">
                                    </div>

                                </div>
                            </form>
                        </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id = "btn_guardar_cambios" >Guardar cambios</button>
                </div> 
            </div>
        </div>
    </div>

    <script>
        
        const t_body = document.getElementById("t-body");
        const btn_guardar_cambios = document.getElementById("btn_guardar_cambios");
        const btn_registrar_prueba = document.getElementById("btn_registrar_prueba");

        function showMessage(title, message, type) {
            Swal.fire({
                title: title,
                html: `<span>${message}</span>`,
                icon: type,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
            });
        }

        function serverQuery($json, onSuccess, onError, onFatal) {
            fetch('http://127.0.0.1/new/backend/api.php', {
                method: 'POST', headers: {
                    'Accept': 'application/json;utf-8'
                }, body: JSON.stringify($json)
            }).then(response => {
                return response.json();
            }).then(json => {
                if (json.status) {
                    onSuccess(json);
                } 
                 else {
                     onError(json);
                 }
            }).catch(err => {
                showMessage("Error", err, 'error');
            });
        }

        function deleteQuery(id){
            serverQuery({
                'endpoint':'Prueba',
                'action':'delete',
                'id':id
            }, (json) => {
                showMessage("Registro eliminado", json.message, "success");
            }, (json) => {
                showMessage("Error", json.message, "error");
            });
        }

        function createQuery(nombre, apellido, edad){

            return serverQuery({
                'endpoint':'Prueba',
                'action':'create',
                'nombre': nombre,
                'apellido': apellido,
                'edad': parseInt(edad)
            }, (json) => {
                showMessage("Registro efectivo", json.message, "success");
            }, (json) => {
                showMessage("Error", json.message, "error");
            });
        }

        function updateQuery(id, nombre, apellido, edad){

            return serverQuery({
                'endpoint':'Prueba',
                'action':'update',
                'id':parseInt(id),
                'nombre': nombre,
                'apellido': apellido,
                'edad': parseInt(edad)
            }, (json) => {
                showMessage("Cambios registrados", json.message, "success");
            }, (json) => {
                showMessage("Error", json.message, "error");
            });
        }

        function readOneQuery(id){

            return serverQuery({
                'endpoint':'Prueba',
                'action':'read_one',
                'id': id
            }, (json) => {
                var {data} = json;
                document.getElementById("id_editar").value = id;
                document.getElementById("nombre_editar").value = data[0].nombre;
                document.getElementById("apellido_editar").value = data[0].apellido;
                document.getElementById("edad_editar").value = data[0].edad;
            }, (json) => {
                showMessage("Error", json.message, "error");
            });
        }

        function editar_btn_function(id){
            var prueba = readOneQuery(id);
            console.log(prueba);

        }

        btn_guardar_cambios.addEventListener("click", () => {
            var id = document.getElementById("id_editar").value;
            var nombre = document.getElementById("nombre_editar").value;
            var apellido = document.getElementById("apellido_editar").value;
            var edad = document.getElementById("edad_editar").value;
            console.log(nombre);
            updateQuery(id, nombre, apellido, edad);
        });

        btn_registrar_prueba.addEventListener("click", () => {
            
            var apellido = document.getElementById("apellido").value;
            var edad = document.getElementById("edad").value;
            var nombre = document.getElementById("nombre").value;

            createQuery(nombre, apellido, edad);
        });

        serverQuery({
            'endpoint':'Prueba',
            'action':'read'
        }, (json) => {
            var {data} = json;
            data.forEach(item => {
                t_body.innerHTML += `
                <tr classname = "item">
                    <th> ${item.id} </th>
                    <td> ${item.nombre} </td>
                    <td> ${item.apellido} </td>
                    <td> ${item.edad} </td>
                    <td>
                        <button type='button' onClick = deleteQuery(${item.id}) class='btn btn-danger btn-borrar '>Borrar</a>
                        <button type='button' onClick = editar_btn_function(${item.id}) class='btn btn-primary ' 
                        data-toggle='modal' data-bs-toggle="modal" data-bs-target="#formulario_editar"</a>Editar</a>
                    </td>
                </tr>`;
                 
            });
        }, (json) => {
            showMessage("Error", json.message, "error");
        });

    </script>
</body>
</html>

