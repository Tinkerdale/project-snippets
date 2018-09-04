  <?php
  session_start();

  ?>

  <!DOCTYPE html>
  <html>
  <head>
  <!--

   -->
  <link rel="stylesheet" href="libs/css/bootstrap.min.css"  type="text/css">
  <link rel="stylesheet" type="text/css" href="scss/custom.css">
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Page Title</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>
  <body>



  <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark ">
  <a class="navbar-brand" href="products.php">Egerton Cafe</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="products.php">Foods</a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          View foods
         </a>
      </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">

    <?php
    require_once 'object/cart_item.php';
    // count products in cart
    if (isset($_SESSION['username'])) {
      // code...
      $cart_item->user_id=$_SESSION['username'];
      $s=$_SESSION['username'];
    }

    $cart_count=$cart_item->count();
    ?>
    <?php
  if (isset($_SESSION['username'])) {
    echo "  <button type='button' class='btn btn-primary'>";
    echo "cart <span class='badge badge-light'><?php echo '$cart_count'; ?></span>";
    echo "<a href='cart.php' style='color:inherit'> view  </a>";
    echo "</button>";

      echo "<a href='logout.php' class='btn btn-outline-success my-2 my-sm-0' >Log out</a>";
    // code...
  }elseif(!isset($_SESSION['username'])){
  echo "  <button type='button' class='btn btn-primary'>";
echo "Shop with us";
  echo "</button>";;
  echo "<a href='loginpage.php' class='btn btn-outline-success my-2 my-sm-0' >Log In</a>";
  echo "  <a href='signuppage.php' class='btn btn-outline-success my-2 my-sm-0' >Sign Up</a>";

  }
     ?>



  </button>

      </form>
  </div>
  </nav>
  </form>
  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js" ></script>
  </body>
  </html>
