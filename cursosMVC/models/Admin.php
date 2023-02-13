<?php
require_once 'config/database.php';
class Admin extends Database{
    //atributos
    private $nomUsuari;
    private $contrasenya;
    //gets y sets
    //nom d'usuari
    public function getNomUsuari(){
        return $this->nomUsuari;
    }

    public function setNomUsuari($nomUsuari){
        $this->nomUsuari = $nomUsuari;
    }
    //contrasenya
    public function getContrasenya(){
        return $this->contrasenya;
    }

    public function setContrasenya($contrasenya){
        $this->contrasenya = $contrasenya;
    }


    //----------------------Metodos----------------//
    public function existeAdmin( $user, $pass){
        $sql = "SELECT * FROM administradores WHERE nombre_Usuario = '$user' and passwd=md5('$pass')";
        $ejecutar = $this->db->query($sql);
        $filas = $ejecutar->rowCount();

        if ($filas>0){
            $existeAdmin = true;
        }
        else{
            $existeAdmin = false;
        }
        return $existeAdmin;
    }

    
    public function salir(){
        session_destroy();
    }
}
?>