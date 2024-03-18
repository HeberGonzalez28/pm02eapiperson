<?php 

/* Toda la logica de programacion del objeto personas 
 Metodos Crud de la aplicacion

 CRUD - Create - Read - Update - Delete
*/

//$n = variable
class Personas
{
    private $tabla = 'personas';

    private $conexion;

    public $id;
    public $nombres;
    public $telefono;
    public $latitud;
    public $longitud;
    public $foto;

    // Constructor de clase
    public function __construct($dbcon)
    {
       $this->conexion = $dbcon;   
    }

    public function createperson()
    {
        $consulta = "INSERT INTO " . $this->tabla . "
                    SET nombres = :nombres,
                        telefono = :telefono,
                        latitud = :latitud,
                        longitud = :longitud,
                        foto = :foto";

        $stm = $this->conexion->prepare($consulta);
        //Limpieza de variables
        $this->nombres = htmlspecialchars(strip_tags($this->nombres));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->latitud = htmlspecialchars(strip_tags($this->latitud));
        $this->longitud = htmlspecialchars(strip_tags($this->longitud));
        $this->foto = htmlspecialchars(strip_tags($this->foto));

        //Binding data
        $stm->bindParam(":nombres", $this->nombres);
        $stm->bindParam(":apellidos", $this->telefono);
        $stm->bindParam(":telefono", $this->latitud);
        $stm->bindParam(":fechanac", $this->longitud);
        $stm->bindParam(":foto", $this->foto);

        if($stm->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getpersons()
    {
        $consulta = "SELECT id, nombres, telefono, latitud, longitud, foto ".
                     "FROM " . $this->tabla ."";

        $stm = $this->conexion->prepare($consulta);
        $stm->execute();
        return $stm;
    }

    /*public function updperson()
    {
        $consulta = "UPDATE " . $this->tabla . "
                SET nombres = :nombres,
                    telefono = :telefono,
                    latitud = :latitud,
                    longitud = :longitud,
                    foto = :foto
                WHERE id = :id";

    $stm = $this->conexion->prepare($consulta);

    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->nombres = htmlspecialchars(strip_tags($this->nombres));
    $this->telefono = htmlspecialchars(strip_tags($this->telefono));
    $this->latitud = htmlspecialchars(strip_tags($this->latitud));
    $this->longitud = htmlspecialchars(strip_tags($this->longitud));
    $this->foto = htmlspecialchars(strip_tags($this->foto));

    $stm->bindParam(":id", $this->id);
    $stm->bindParam(":nombres", $this->nombres);
    $stm->bindParam(":telefono", $this->telefono);
    $stm->bindParam(":latitud", $this->latitud);
    $stm->bindParam(":longitud", $this->longitud);
    $stm->bindParam(":foto", $this->foto);

        if($stm->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delperson()
    {
        $consulta = "DELETE FROM " . $this->tabla . " WHERE id = :id";
        $stm = $this->conexion->prepare($consulta);
    
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stm->bindParam(":id", $this->id);
    
        try {
            if($stm->execute()) {
                return true;
            } else {
                return false;
            }
    }*/
}
?>