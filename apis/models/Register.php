<?php

class Register {
  // DB stuff
  private $c;
  private $table = 'user';

  // Properties
  public $username;
  public $email;
  public $userpassword;

  // Constructor with DB
  public function __construct($db)
  {
    $this->c = $db;
  }

  public function read(){
    // Create query
    $query = 'SELECT
        *
      FROM
      '. $this->table .'
      ORDER BY
        created_at DESC';

      //Prepare Statement
      $stmt = $this->c->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
  }

  // Get categories
  public function register(){
    // Create query
    $query = 'INSERT INTO ' .
          $this->table . '
        SET
          username     = :name,
          email        = :email,
          userpassword = :password
          ';

      // Prepare statement
      $stmt = $this->c->prepare($query);

      // Clean data
      $this->username       = htmlspecialchars(strip_tags($this->username));
      $this->email          = htmlspecialchars(strip_tags($this->email));
      $this->userpassword   = password_hash(htmlspecialchars(strip_tags($this->userpassword)), PASSWORD_DEFAULT);

      // Bind data
      $stmt->bindParam(':name', $this->username);
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':password', $this->userpassword);

      // Execute query
      if($stmt->execute()){
        return true;
      }

      // Print error if something goes wrong
      print_f("Error: %s.\n", $stmt->error);

      return false;
  }
  
}