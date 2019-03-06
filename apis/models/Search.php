<?php

class Search {
  // DB stuff
  private $c;
  private $table = 'items';

  // Properties
  public $id;
  public $title;

  // Constructor with DB
  public function __construct($db)
  {
    $this->c = $db;
  }

  public function read(){
    // Create query
    $query = 
    "SELECT 
      * 
    FROM 
    ". $this->table ." 
    WHERE
     title 
    LIKE '%$search%' 
    OR 
      description 
    LIKE '%$search%' 
    OR 
      author 
    LIKE '%$search%'";
    
      //Prepare Statement
    $stmt = $this->c->prepare($query);

      // Execute query
    $stmt->execute();

    return $stmt;
  }

  public function search(){

    // Search query
    $query = 
        "SELECT
        *
        FROM
        ". $this->table ."
        WHERE
          title  = :title";

    // Prepare statement
    $stmt = $this->c->prepare($query);

    // Clean data
    $this->title = htmlspecialchars(strip_tags($this->title));

    // Bind data
    $stmt->bindParam(':title', $this->title);

    // Execute query
    if($stmt->execute()){
      return $stmt;
    }

    // Print error if something goes wrong
    print_f("Error: %s.\n", $stmt->error);

    return false;
  }

}