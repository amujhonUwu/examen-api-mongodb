<?php

    function serverQuery(string $token, array $request){
        global $config;
        $init = curl_init("http://localhost/new/backend/api.php");
        curl_setopt($init, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Cookie: token=' . $token)); // Inject the token into the header
        curl_setopt($init, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($init, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($init, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($init, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($init);
        $result = preg_replace("/\xEF\xBB\xBF/", "", $result);
        curl_close($init);
        return json_decode($result, true);
    }

    function deleteQuery(int $id){
        $result = serverQuery("", [
            "endpoint" => "Prueba",
            "action" => "delete",
            "id" => $id
        ]);
    }

    function editQuery(int $id, string $nombre, string $apellido, int $edad){
        $result = serverQuery("", [
            "endpoint" => "Prueba",
            "action" => "edit",
            "id" => $id,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "edad" => $edad
        ]);
    }

    function createQuery(string $nombre, string $apellido, int $edad){
        $result = serverQuery("", [
            "endpoint" => "Prueba",
            "action" => "create",
            "nombre" => $nombre,
            "apellido" => $apellido,
            "edad" => $edad
        ]);
    }

    function readOneQuery(int $id){
        $result = serverQuery("", [
            "endpoint" => "Prueba",
            "action" => "read_one",
            "id" => $id
        ]);

        return $result;
    }

    function updateQuery(int $id, string $nombre, string $apellido, int $edad){
        $result = serverQuery("", [
            "endpoint" => "Prueba",
            "action" => "update",
            "id" => $id,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "edad" => $edad
        ]); 
    }
?>