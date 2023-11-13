
<?php

include_once(__DIR__ . '/../DB/conexionDB.php');


class Empleado 
{
    //public $id_usuario;
    public $id;
    public $id_area;
    public $nombre_puesto;

    public static function crearEmpleado($id_area, $nombre_puesto)
    {
        $empleadoAux = new Empleado();
        $empleadoAux->id_area = $id_area;
        $empleadoAux->nombre_puesto = $nombre_puesto;
        
        return $empleadoAux;
    }

    public function agregarEmpleado()
    {
        $instanciaAcceso = ConexionDB::acceso();
        $consulta = $instanciaAcceso->consulta("INSERT INTO empleado (id_area, nombre_puesto) VALUES (:ia, :np)");
        // Bindeo:
        $consulta->bindValue(":ia", $this->id_area, PDO::PARAM_STR);
        $consulta->bindValue(":np", $this->nombre_puesto, PDO::PARAM_STR);

        return $consulta->execute(); 
    }


    public static function obtenerEmpleados()
    {
        $instanciaAcceso = ConexionDB::acceso();
        $consulta = $instanciaAcceso->consulta("SELECT * FROM empleado");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function puestoExiste($nombre_puesto)
    {
 
        $instanciaAcceso = ConexionDB::acceso();
        $consulta = $instanciaAcceso->consulta("SELECT * FROM empleado where nombre_puesto = :n");
        $consulta->bindValue(":n", $nombre_puesto, PDO::PARAM_STR);
        $consulta->execute();

        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($resultados)) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

  

}

?>