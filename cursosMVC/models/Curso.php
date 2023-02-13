<?php
require_once 'config/database.php';
class Curso extends Database{
    //atributos
    private $id;
    private $nombreCurso;
    private $descripcion;
    private $horas;
    private $fechaInicio;
    private $fechaFinal;
    private $profesor;
    private $estado; 

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNombreCurso(){
        return $this->nombreCurso;
    }

    public function setNombreCurso($nombreCurso){
        $this->nombreCurso = $nombreCurso;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getHoras(){
        return $this->horas;
    }

    public function setHoras($horas){
        $this->horas = $horas;
    }

    public function getFechaInicio(){
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio){
        $this->fechaInicio = $fechaInicio;
    }

    public function getFechaFinal(){
        return $this->fechaFinal;
    }

    public function setFechaFinal($fechaFinal){
        $this->fechaFinal = $fechaFinal;
    }

    public function getProfesor(){
        return $this->profesor;
    }

    public function setProfesor($profesor){
        $this->profesor = $profesor;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    //----------------------Metodos----------------//
    public function mostrarTodos(){
        $sql = "SELECT * FROM cursos INNER JOIN profesores WHERE DNI=profesor";
        $rows = $this->db->query($sql);
        return $rows;
    }
    
    public function buscar(){
        $search = "%".$this->getNombreCurso()."%";
        $sql = "SELECT * FROM cursos INNER JOIN profesores WHERE profesor=DNI AND nombreC LIKE '$search'";
        $rows = $this->db->query($sql);
        return $rows;
    }

    public function nombreDuplicado(){
        $sql = "SELECT nombrec FROM cursos WHERE nombreC='".$this->getNombreCurso()."'";
        $resultado = $this->db->query($sql);
        $filas = $resultado->rowCount();
        return $filas;
    }

    public function insertarCurso(){
        $sql = "INSERT INTO cursos(nombreC , descripcion , horas , fechaInicio , fechaFinal , profesor) VALUES ('".$this->getNombreCurso()."','".$this->getDescripcion()."','".$this->getHoras()."','".$this->getFechaInicio()."','".$this->getFechaFinal()."','".$this->getProfesor()."')";
        $rows = $this->db->query($sql);
    }

    public function desactivarCurso(){
        $sql = "UPDATE cursos SET Estado = 0 WHERE codigo='".$this->getId()."'";
        $rows = $this->db->query($sql);
    }

    public function activarCurso(){
        $sql = "UPDATE cursos SET Estado = 1 WHERE codigo='".$this->getId()."'";
        $rows = $this->db->query($sql);
    }
    
    public function datosCurso(){
        $sql = "SELECT * FROM cursos INNER JOIN profesores WHERE DNI=profesor AND codigo ='".$this->getId()."'";
        $rows = $this->db->query($sql);
        return $rows;
    }

    public function modificarCurso(){
        $sql = "UPDATE cursos SET nombreC='".$this->getNombreCurso()."',descripcion='".$this->getDescripcion()."',horas='".$this->getHoras()."',fechaInicio='".$this->getFechaInicio()."',fechaFinal='".$this->getFechaFinal()."',profesor='".$this->getProfesor()."' WHERE codigo='".$this->getId()."'";
        $this->db->query($sql);
    }
    public function activo(){
        $sql="SELECT * FROM cursos INNER JOIN profesores WHERE DNI = profesor AND codigo='".$this->getId()."'";
        $rows = $this->db->query($sql);
        return $rows;
    }
    public function cursosDisponibles(){
        $date = date("Y-m-d");
        $alumno = $_SESSION['alumno'];
        $sql = "SELECT * FROM cursos INNER JOIN profesores WHERE DNI = profesor AND Estado = 1 AND fechaInicio > $date AND codigo NOT IN (SELECT codigo_curso FROM matricula WHERE codigo_curso = codigo and email_alumno='$alumno')";
        $rows=$this->db->query($sql);
        return $rows;
    }

    public function cursosProfesorLogeado(){
        $sql = "SELECT * FROM cursos WHERE profesor = '".$this->getProfesor()."'";
        $rows = $this->db->query($sql);
        return $rows;
    }

    public function cursoSeleccionado(){
        $sql = "SELECT * FROM cursos WHERE codigo='".$this->getId()."'";
        $rows = $this->db->query($sql);
        return $rows;
    }
    public function buscarCursosDisponible(){
        $date = date("Y-m-d");
        $alumno = $_SESSION['alumno'];
        $search = "%".$this->getNombreCurso()."%";
        $sql = "SELECT * FROM cursos INNER JOIN profesores WHERE DNI = profesor AND nombreC LIKE '$search' AND fechaInicio > $date AND Estado = 1 AND codigo NOT IN (SELECT codigo_curso FROM matricula WHERE codigo_curso = codigo and email_alumno='$alumno')";
        $rows=$this->db->query($sql);
        return $rows;
    }

    public function buscarMisCursos($email){
        $search = "%".$this->getNombreCurso()."%";
        $sql = "SELECT * FROM cursos INNER JOIN matricula ON codigo = codigo_curso INNER JOIN alumnos ON email_alumno = email WHERE email_alumno = '$email' AND nombreC LIKE '$search'";
        $rows=$this->db->query($sql);
        return $rows;
    }

    public function buscarCursosPorfesor(){
        $search = "%".$this->getNombreCurso()."%";
        $sql = "SELECT * FROM cursos WHERE profesor = '".$this->getProfesor()."' AND nombreC LIKE '$search'" ;
        $rows=$this->db->query($sql);
        return $rows;
    }
    public function salir(){
        session_destroy();
    }
}
?>