<?php

//Permitamos el origen de cualquier lado que se pueda consumir la api.
header("Access-Control-Allow-Origin: *");
//El tipo de contenido es aplicacion JSON.
header("Content-Type: application/json; charset=UTF-8");
//El tipo de metodo sera el POST.
header("Access-Control-Allow-Methods: POST");
//El tiempo de vida de la peticion.
header("Access-Control-Max-Age: 3600");
//Autorizaciones para consumir las peticiones.
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'Database.php';
include_once 'Personas.php';

$db = new Database();
$instancia = $db->getConnection();
$item = new Personas($instancia);
$data = json_decode(file_get_contents("php://input"));

if(isset($data))
{
    $item->nombres = $data->nombres;
    $item->apellidos = $data->apellidos;
    $item->telefono = $data->telefono;
    $item->fechanac = $data->fechanac;
    $item->foto = $data->foto;

    if($item->createperson())
    {
        http_response_code(200);
        echo json_encode(array("message" =>"Persona Creada"));
    }
    else
    {
        http_response_code(400);
        echo json_encode(array("message" =>"Persona no Creada"));
    }
}
else
{
    http_response_code(404);
    echo json_encode(array("message" =>"Sin Datos"));
}

?>