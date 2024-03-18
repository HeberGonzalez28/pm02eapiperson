<?php

// Permitamos el origen de cualquier lado que se pueda consumir la api.
header("Access-Control-Allow-Origin: *");
// El tipo de contenido es aplicación JSON.
header("Content-Type: application/json; charset=UTF-8");
// El tipo de método será POST.
header("Access-Control-Allow-Methods: POST");
// El tiempo de vida de la petición.
header("Access-Control-Max-Age: 3600");
// Autorizaciones para consumir las peticiones.
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'Database.php';
include_once 'Personas.php';

$db = new Database();
$instancia = $db->getConnection();
$item = new Personas($instancia);
$data = json_decode(file_get_contents("php://input"));

if(isset($data->id)) {
    $item->id = $data->id;
    $item->nombres = $data->nombres;
    $item->apellidos = $data->apellidos;
    $item->telefono = $data->telefono;
    $item->fechanac = $data->fechanac;
    $item->foto = $data->foto;

    if($item->updperson()) {
        http_response_code(200);
        echo json_encode(array("message" => "Persona actualizada"));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Error al actualizar la persona"));
    }
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Datos insuficientes para actualizar la persona"));
}

?>