<?php

  class Item {
    // DB stuff
    private $c;
    private $table = 'items';

    // Post Properties
    public $id;
    public $title;
    public $description;
    public $img;
    public $category_id;
    public $author;
    public $created_at;

    // Constructor with DB
    public function __construct($db)
    {
      $this->c = $db;
    }

    // Get Posts
    public function read(){
      // Create query
      $query = 
      'SELECT 
        c.name as category_name,
        i.id,
        i.title,
        i.description,
        i.img,
        i.category_id,
        i.author,
        i.created_at
      FROM
        '.$this->table.' i
      LEFT JOIN
        categories c ON i.category_id = c.id
      ORDER BY
        i.created_at 
      DESC';
      
      // Prepare statement
      $stmt = $this->c->prepare($query);
      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post 
    public function read_single(){
      $query =
      'SELECT 
        c.name as category_name,
        i.id,
        i.title,
        i.description,
        i.img,
        i.category_id,
        i.author,
        i.created_at
      FROM
        '.$this->table.' i
      LEFT JOIN
        categories c ON i.category_id = c.id
      WHERE 
        i.id = ?
      LIMIT 0,1';
      
      //Prepare Statement
      $stmt = $this->c->prepare($query);
      
      // Bind ID
      $stmt->bindParam(1, $this->id);
      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // Set porperties
      $this->title = $row['title'];
      $this->description = $row['description'];
      $this->img = $row['img'];
      $this->category_id = $row['category_id'];
      $this->author = $row['author'];
      $this->category_name = $row['category_name'];
      $this->created_at = $row['created_at'];

    }

    // Create Post
    public function create(){
      // Create query
      $query = 'INSERT INTO ' .
            $this->table . '
          SET
            title  = :title,
            description   = :description,
            img = :img,
            category_id = :category_id,
            author = :author
            ';

        // Prepare statement
        $stmt = $this->c->prepare($query);

        // Clean data
        $this->title       = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->img         = htmlspecialchars(strip_tags($this->img));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->author      = htmlspecialchars(strip_tags($this->author));

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':img', $this->img);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':author', $this->author);

        // Execute query
        if($stmt->execute()){
          return true;
        }

        // Print error if something goes wrong
        print_f("Error: %s.\n", $stmt->error);

        return false;
    }


    // Update Post
    public function update(){
      // Create query
      $query = 'UPDATE ' .
            $this->table . '
          SET
            title         = :title,
            description   = :description,
            img           = :img,
            category_id   = :category_id,
            author        = :author
          WHERE
            id            = :id';

        // Prepare statement
        $stmt = $this->c->prepare($query);

        // Clean data
        $this->title       = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->img         = htmlspecialchars(strip_tags($this->img));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->author      = htmlspecialchars(strip_tags($this->author));
        $this->id          = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':img', $this->img);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()){
          return true;
        }

        // Print error if something goes wrong
        print_f("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete Post
    public function delete(){
      // Delete query
      $query = 'DELETE FROM '. $this->table .' WHERE id = :id';

      // Prepare statement
      $stmt = $this->c->prepare($query);

      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));
      
      // Bind data
      $stmt->bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()){
        return true;
      }

      // Print error if something goes wrong
      print_f("Error: %s.\n", $stmt->error);

      return false;

    }


  }