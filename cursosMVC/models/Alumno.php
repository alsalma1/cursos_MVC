<?php
require_once 'config/database.php';
class Alumno extends Database{
    //atributos
    private $dni;
    private $email;
    private $nombre;
    private $apellidos;
    private $edad;
    private $foto;
    private $contrasenya;

    public function getDni(){
        return $this->dni;
    }
    public function setDni($dni){
        $this->dni = $dni;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    public function getEdad(){
        return $this->edad;
    }

    public function setEdad($edad){
        $this->edad = $edad;
    }

    public function getContrasenya(){
        return $this->contrasenya;
    }

    public function setContrasenya($contrasenya){
        $this->contrasenya = $contrasenya;
    }

    public function getFoto(){
        return $this->foto;
    }

    public function setFoto($foto){
        $this->foto = $foto;
    }

    //----------------------Metodos----------------//
    public function existeAlumno($email, $pass){
        $sql = "SELECT * FROM alumnos WHERE email = '$email' and passwd=md5('$pass')";
        $ejecutar = $this->db->query($sql);
        $filas = $ejecutar->rowCount();

        if ($filas>0){
            $existeAlumno = true;
        }
        else{
            $existeAlumno = false;
        }
        return $existeAlumno;
    }

    public function crearCuenta(){
        $sql = "INSERT INTO alumnos(DNI,email,nombre,apellidos,edad,fotografia,passwd) VALUES('".$this->getDni()."','".$this->getEmail()."','".$this->getNombre()."','".$this->getApellidos()."','".$this->getEdad()."','".$this->getFoto()."','".md5($this->getContrasenya())."')";
        $this->db->query($sql);
    }

    public function datosDuplicados(){
        $sql = "SELECT * FROM alumnos WHERE DNI='".$this->getDni()."' OR email='".$this->getEmail()."'";
        $rows = $this->db->query($sql);
        $filas = $rows->rowCount();
        return $filas;
    }

    public function salir(){
        session_destroy();
    }
}
?>