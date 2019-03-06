<?php
  class Database {
    // DB Params
    private $host       = 'localhost'; 
    private $db_name    = 'donation'; 
    private $username   = 'root'; 
    private $password   = '';
    private $c; 

    // DB Connect
    public function connect(){
      $this->c = null;

      try{
        $this->c = new PDO('mysql:host='.$this->host . ';dbname='. $this->db_name, $this->username,$this->password);
        $this->c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e){
        echo 'Connection Error: '. $e->getMessage();
      }

      return $this->c;
    }
  }



?>