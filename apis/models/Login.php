<?php

class Login {
  // DB stuff
  private $c;
  private $table = 'user';

  // Properties
  public $id;
  public $email;
  public $password;

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
  public function login(){
    // Create query
    $query = 'SELECT
        id,
        email,
        userpassword
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

  // // Get Single Login 
  // public function read_single(){
  //   $query =
  //   'SELECT *
  //   FROM
  //     '.$this->table.'
  //   WHERE 
  //     id = ?
  //   LIMIT 0,1';
    
  //   //Prepare Statement
  //   $stmt = $this->c->prepare($query);
    
  //   // Bind ID
  //   $stmt->bindParam(1, $this->id);
  //   // Execute query
  //   $stmt->execute();

  //   $row = $stmt->fetch(PDO::FETCH_ASSOC);

  //   // Set porperties
  //   $this->name = $row['name'];
  //   $this->created_at = $row['created_at'];

  // }

  // // Create Category
  // public function create(){
  //   // Create query
  //   $query = 'INSERT INTO ' .
  //         $this->table . '
  //       SET
  //         name  = :name';

  //     // Prepare statement
  //     $stmt = $this->c->prepare($query);

  //     // Clean data
  //     $this->name       = htmlspecialchars(strip_tags($this->name));

  //     // Bind data
  //     $stmt->bindParam(':name', $this->name);

  //     // Execute query
  //     if($stmt->execute()){
  //       return true;
  //     }

  //     // Print error if something goes wrong
  //     print_f("Error: %s.\n", $stmt->error);

  //     return false;
  // }


  // // Update Category
  // public function update(){
  //   // Update query
  //   $query = 'UPDATE ' .
  //         $this->table . '
  //       SET
  //         name  = :name
  //       WHERE
  //         id     = :id';

  //     // Prepare statement
  //     $stmt = $this->c->prepare($query);
  //     // Clean data
  //     $this->name   = htmlspecialchars(strip_tags($this->name));
  //     $this->id     = htmlspecialchars(strip_tags($this->id));

  //     // Bind data
  //     $stmt->bindParam(':name', $this->name);
  //     $stmt->bindParam(':id', $this->id);

  //     // Execute query
  //     if($stmt->execute()){
  //       return true;
  //     }
  //     // Print error if something goes wrong
  //     print_f("Error: %s.\n", $stmt->error);
  //     return false;
  // }


  // // Delete Post
  // public function delete(){
  //   // Delete query
  //   $query = 'DELETE FROM '. $this->table .' WHERE id = :id';

  //   // Prepare statement
  //   $stmt = $this->c->prepare($query);

  //   // Clean data
  //   $this->id = htmlspecialchars(strip_tags($this->id));
    
  //   // Bind data
  //   $stmt->bindParam(':id', $this->id);

  //   // Execute query
  //   if($stmt->execute()){
  //     return true;
  //   }

  //   // Print error if something goes wrong
  //   print_f("Error: %s.\n", $stmt->error);

  //   return false;

  // }
  
}