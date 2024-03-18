<?php

// Permitir el acceso desde cualquier origen que consuma la API.
header("Access-Control-Allow-Origin: *");
// Establecer el tipo de contenido como aplicación JSON.
header("Content-Type: application/json; charset=UTF-8");
// Permitir el método DELETE.
header("Access-Control-Allow-Methods: DELETE");
// Establecer el tiempo de vida de la petición.
header("Access-Control-Max-Age: 3600");
// Permitir ciertos encabezados en las peticiones.
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'Database.php';
include_once 'Personas.php';

$db = new Database();
$instancia = $db->getConnection();
$item = new Personas($instancia);
$data = json_decode(file_get_contents("php://input"));

if(isset($data->id)) {
    $item->id = $data->id;

    if($item->delperson()) {
        http_response_code(200);
        echo json_encode(array("message" => "Persona eliminada"));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Error al eliminar la persona"));
    }
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Datos insuficientes para eliminar la persona"));
}

?>