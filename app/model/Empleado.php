
<?php

include_once(__DIR__ . '/../DB/conexionDB.php');

class Empleado 
{

    public $id;
    public $id_usuario;
    public $id_area;
    public $nombre;
    public $fecha_inicio;
    public $fecha_fin;

    public static function crearEmpleado($id_usuario, $id_area, $nombre, $fecha_inicio)
    {
        $empleadoAux = new Empleado();
        $empleadoAux->id_usuario = $id_usuario;
        $empleadoAux->id_area = $id_area;
        $empleadoAux->nombre = $nombre;
        $empleadoAux->fecha_inicio = $fecha_inicio;
        
        return $empleadoAux;
    }

    public function agregarEmpleado()
    {
        $instanciaAcceso = ConexionDB::acceso();
        $consulta = $instanciaAcceso->consulta("INSERT INTO empleado (Id_area, Nombre, Fecha_inicio, Fecha_fin, Id_usuario) VALUES (:ia, :n, :fi, :ff, :iu)");
        // Bindeo:
        $consulta->bindValue(":ia", $this->id_area, PDO::PARAM_STR);
        $consulta->bindValue(":n", $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(":fi", $this->fecha_inicio, PDO::PARAM_STR);
        $consulta->bindValue(":ff", $this->fecha_fin, PDO::PARAM_STR);
        $consulta->bindValue(":iu", $this->id_usuario, PDO::PARAM_STR);

        return $consulta->execute(); // Devuelve true si la inserción fue exitosa, false en caso contrario.
    }


    public static function obtenerEmpleados()
    {
        $instanciaAcceso = ConexionDB::acceso();
        $consulta = $instanciaAcceso->consulta("SELECT * FROM empleado");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>