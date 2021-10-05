<?php

class DbConnection {
  
    public    $host= "localhost";
    protected $database= "catholicdb";
    private   $user= "root";
    private   $password= "";
    public $con;

    public function connection(){
        try{
            $dsn= "mysql:host=$this->host; dbname=$this->database";
            $this->con = new PDO($dsn, $this->user, $this->password);
            return $this->con;
        } catch(PDOException $err ) {
            echo "OOPS! ERROR OCCURED".$err->getMessage();
        }
    }
}

?>