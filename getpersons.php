<?php

//Permitamos el origen de cualquier lado que se pueda consumir la api.
header("Access-Control-Allow-Origin: *");
//El tipo de contenido es aplicacion JSON.
header("Content-Type: application/json; charset=UTF-8");
//El tipo de metodo sera el GET.
header("Access-Control-Allow-Methods: GET");
//El tiempo de vida de la peticion.
header("Access-Control-Max-Age: 3600");
//Autorizaciones para consumir las peticiones.
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'Database.php';
include_once 'Personas.php';


try
{
    $db = new Database();
$instancia = $db->getConnection();

$items = new Personas($instancia);
$personas = $items->getpersons();

$personcount = $personas->rowCount();

if($personcount > 0)
{
    $arreglopersonas = array();

    while($row = $personas->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $e = array
        (
            "id"=> $id,
            "nombres"=> $nombres,
            "apellidos"=> $apellidos,
            "telefono"=> $telefono,
            "fechanac"=> $fechanac,
            "foto"=> $foto
        );
        $arreglopersonas[] = $e;
    }
    http_response_code(200);
    echo json_encode($arreglopersonas);
}
else
{
    http_response_code(404);
    echo json_encode(array("message"=>"No hay registros"));
}
} catch(PDOException){
    http_response_code(500);
    echo json_encode(array("message"=>"Error de conexion". $e->getMessage()));
}

?>