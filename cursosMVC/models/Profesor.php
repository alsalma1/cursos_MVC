<?php
require_once 'config/database.php';
class Profesor extends Database{
    //atributos
    private $dni;
    private $nombre;
    private $apellido;
    private $nombreUsu;
    private $contrasenya;
    private $tiutloAcademico;
    private $foto;

    public function getDni(){
        return $this->dni;
    }
    public function setDni($dni){
        $this->dni = $dni;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function getNombreUsu(){
        return $this->nombreUsu;
    }

    public function setNombreUsu($nombreUsu){
        $this->nombreUsu = $nombreUsu;
    }

    public function getContrasenya(){
        return $this->contrasenya;
    }

    public function setContrasenya($contrasenya){
        $this->contrasenya = $contrasenya;
    }

    public function getTituloAcademico(){
        return $this->tiutloAcademico;
    }

    public function setTituloAcademico($tiutloAcademico){
        $this->tiutloAcademico = $tiutloAcademico;
    }

    public function getFotos(){
        return $this->foto;
    }

    public function setFoto($foto){
        $this->foto = $foto;
    }

    //----------------------Metodos----------------//
    public function existeProfesor($dni, $pass){
        $sql = "SELECT * FROM profesores WHERE dni = '$dni' and passwd=md5('$pass')";
        $ejecutar = $this->db->query($sql);
        $filas = $ejecutar->rowCount();

        if ($filas>0){
            $existeProfesor = true;
        }
        else{
            $existeProfesor = false;
        }
        return $existeProfesor;
    }

    public function comprobarActivo($dni,$pass){
        $sql = "SELECT estadop FROM profesores WHERE dni = '$dni' and passwd=md5('$pass')";
        $rows = $this->db->query($sql);
        return $rows;
    }
    public function mostrarTodos(){
        $sql = "SELECT * FROM profesores";
        $rows = $this->db->query($sql);
        return $rows;
    }

    public function buscar(){
        $search = "%".$this->getNombre()."%";
        $sql = "SELECT * FROM profesores WHERE nombre LIKE '$search'";
        $rows = $this->db->query($sql);
        return $rows;
    }

    public function profesoresActivos(){
        $sql = "SELECT * FROM profesores WHERE estadop = 1";
        $rows = $this->db->query($sql);
        return $rows;
    }

    public function dniDuplicado(){
        $sql = "SELECT DNI FROM profesores WHERE DNI='".$this->getDni()."'";
        $resultado = $this->db->query($sql);
        $filasDni = $resultado->rowCount();
        return $filasDni;
    }

    public function insertar(){
        $sql = "INSERT INTO profesores(DNI,nombre,apellidos,titulo_academico,fotografia,passwd,NombreUsu) VALUES ('".$this->getDni()."','".$this->getNombre()."','".$this->getApellido()."','".$this->getTituloAcademico()."','".$this->getFotos()."','".md5($this->getContrasenya())."','".$this->getNombreUsu()."')";
        $rows = $this->db->query($sql);
    }
    
    public function desactivarProfesor(){
        $sql = "UPDATE profesores SET estadop = 0 WHERE DNI='".$this->getDni()."'";
        $sql2 = "UPDATE cursos SET estado = 0 WHERE profesor= '".$this->getDni()."'";
        $this->db->query($sql);
        $this->db->query($sql2);
    }

    public function activarProfesor(){
        $sql = "UPDATE profesores SET estadop = 1 WHERE DNI='".$this->getDni()."'";
        $rows = $this->db->query($sql);
    }

    public function datosProfesorEditar(){
        $sql = "SELECT * FROM profesores WHERE DNI='".$this->getDni()."'";
        $rows = $this->db->query($sql);
        return $rows;
    }

    public function editarDatos(){
        $sql = "UPDATE profesores SET nombre='".$this->getNombre()."',apellidos='".$this->getApellido()."',titulo_academico='".$this->getTituloAcademico()."',NombreUsu='".$this->getNombreUsu()."' WHERE DNI='".$this->getDni()."'";
        $this->db->query($sql);
    }

    public function modificarFoto(){
        $sql = "UPDATE profesores SET fotografia='".$this->getFotos()."' WHERE DNI='".$this->getDni()."'";
        $this->db->query($sql);
    }

    public function salir(){
        session_destroy();
    }
}
?>