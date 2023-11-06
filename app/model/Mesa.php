<?php


 class Mesa 
 {
    public $id;
    public $codigo_mesa;
    public $id_empleado;
    public $estado;

    public function __construct() {}

    public static function crearMesa($table_code, $employee_id, $state) 
    {
        $table = new Mesa();
        $table->setCodigoMesa($table_code);
        $table->setIdEmpleado($employee_id);
        $table->setEstado($state);

        return $table;
    }

    //--- Getters ---//
    public function getId(){
        return $this->id;
    }

    public function getCodigoMesa(){
        return $this->codigo_mesa;
    }

    public function getIdEmpleado(){
        return $this->id_empleado;
    }

    public function getEstado(){
        return $this->estado;
    }

    //--- Setters ---//

    public function setId($id){
        $this->id = $id;
    }

    public function setCodigoMesa($codigo){
        $this->codigo_mesa = $codigo;
    }

    public function setIdEmpleado($id){
        $this->id_empleado = $id;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public static function obtenerMesas(){
        $objDataAccess = ConexionDB::acceso();
        $query = $objDataAccess->consulta('SELECT * FROM mesa');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    public static function agregarMesa($mesa){
        $objDataAccess = ConexionDB::acceso();
        $query = $objDataAccess->consulta('INSERT INTO mesa (codigo_mesa, id_empleado, estado) 
        VALUES (:table_code, :employee_id, :state)');
        $query->bindValue(':table_code', $mesa->getCodigoMesa());
        $query->bindValue(':employee_id', $mesa->getIdEmpleado());
        $query->bindValue(':state', $mesa->getEstado());
        

        return $query->execute();
    }
 }
?>