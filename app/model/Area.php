<?php

include_once(__DIR__ . '/../DB/conexionDB.php');


 class Area {
        public $id;
        public $descripcion;
        
        // public static $areas_trabajo = array(
        //     'Mozo' => 1,
        //     'Cocinero' => 2,
        //     'Barman' => 3,
        //     'Admin' => 4
        // );

        public function __construct(){}

        //--- Getters ---//

        public function getId(){
            return $this->id;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }

        public Static function getAreaByJobs($job){
            return intval(self::$areas_trabajo[$job]);
        }

        //--- Setters ---//

        public function setAreaId($id){
            $this->id = $id;
        }
        public function setAreaDescription($descripcion){
            $this->descripcion = $descripcion;
        }


        public function agregarArea()
        {
            $objDataAccess = ConexionDB::acceso();
            $sql = "INSERT INTO area (area_description) VALUES (:area_description);";
            $query = $objDataAccess->consulta($sql);
            $query->bindValue(':area_description', $this->getDescripcion());
            $query->execute();

            return $objDataAccess->getLastInsertedID();
        }

        public static function obtenerAreas(){
            $objDataAccess = ConexionDB::acceso();
            $sql = "SELECT * FROM area;";
            $query = $objDataAccess->consulta($sql);
            $query->execute();
            $areas = $query->fetchAll(PDO::FETCH_CLASS, 'Area');
            return $areas;
        }

 }
?>