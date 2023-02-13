<?php
require_once 'config/database.php';
class Matricula extends Database{
    //atributos
    private $emailAlumno;
    private $idCurso;
    private $nota;

    public function getEmailAlumno(){
        return $this->emailAlumno;
    }

    public function setEmailAlumno($emailAlumno){
        $this->emailAlumno = $emailAlumno;
    }

    public function getIdCurso(){
        return $this->idCurso;
    }

    public function setIdCurso($idCurso){
        $this->idCurso = $idCurso;
    }

    public function getNota(){
        return $this->nota;
    }

    public function setNota($nota){
        $this->nota = $nota;
    }

    //Metodos
    public function darAlta(){
        $sql = "INSERT INTO matricula(email_alumno , codigo_curso) VALUES ('".$this->getEmailAlumno()."','".$this->getIdCurso()."')";
        $this->db->query($sql);
    }

    public function darBaja(){
        $sql = "DELETE FROM matricula WHERE email_alumno = '".$this->getEmailAlumno()."' AND codigo_curso = '".$this->getIdCurso()."'";
        $this->db->query($sql);
    }

    public function misCursos(){
        $email = $_SESSION['alumno'];
        $sql = "SELECT * FROM matricula INNER JOIN cursos ON codigo_curso = codigo INNER JOIN alumnos ON email_alumno = email WHERE email_alumno = '$email'";
        $rows = $this->db->query($sql);
        return $rows;
    }

    public function alumnosMatriculados(){
        $dni = $_SESSION['profesor'];
        $sql = "SELECT * FROM cursos c INNER JOIN matricula m ON codigo_curso = codigo INNER JOIN alumnos a ON email_alumno = email WHERE profesor = '$dni' and codigo = '".$this->getIdCurso()."'";
        $rows = $this->db->query($sql);
        return $rows;
    }

    public function insertarNota(){
        $sql = "UPDATE matricula SET nota='".$this->getNota()."' WHERE email_alumno='".$this->getEmailAlumno()."' AND codigo_curso='".$this->getIdCurso()."'";
        $this->db->query($sql);
    }
}
?>