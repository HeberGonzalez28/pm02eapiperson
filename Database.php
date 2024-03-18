<?php

class Database
{
    private $host = "localhost";
    private $databasename = "DBPM02EPER";
    private $username = "root";
    private $password = "";

    public $conexion;

    public function getConnection(){
        $this->conn = null;

        try{

            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->databasename, $this->username, $this->password);
            $this->conn->exec("set names utf8");

            //echo "Database could be connected ";

        }
        catch(PDOException $exception)
        {
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

?>