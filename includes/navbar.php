<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="<?= ROOT_URL; ?>" class="navbar-brand pd-left-0">Donation</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-sub navbar-right">
        <?php
          if (isset($_SESSION['id'])) {
            
            echo '<li><a class="" href="'.ROOT_URL.'"> Welcome <span class="text-success text-uppercase">'.$_SESSION["name"] .'! </span></a></li>
                    <li><a href="'.ROOT_URL.'logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
          } else {
            echo '<li><a href="'.ROOT_URL.'login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
          }
        ?>
      </ul>

      <div class="form-inline navbar-right">
        <div class="input-group">
          <form action="search.php" method="GET" class="navbar-form">
            <div class="form-group input-group-btn form-inline">
              <input type="text" name="search" class="form-control" placeholder="search items..">
              <button name="submit" type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
            </div>
          </form>
        </div>
      </div>

      <ul class="nav navbar-nav">
        <li><a href="<?= ROOT_URL; ?>">Home</a></li>
        <?php if(isset($_SESSION['id'])) : ?>
        <li><a href="<?= ROOT_URL; ?>additem.php">Add Item</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
