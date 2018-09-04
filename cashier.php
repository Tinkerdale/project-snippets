<?php
    // include database and object files
     require_once 'C:\xampp\htdocs\GROUP4\config\dbconnection.php';
     require_once 'C:\xampp\htdocs\GROUP4\Admin\cashiercreate.php';

    // get database connection
    $database = new dbConnect();
    $db = $database->connect();

    // pass connection to objects
    $cashier = new Cashier($db);
    // set page headers
    $page_title = "Create Cashier";
     require_once 'C:\xampp\htdocs\GROUP4\adminlay.php';

     echo "<div class='right-button-margin'>";
     echo "<a href='AllProducts.php' class='btn btn-primary custom-btn pull-right' style='margin-bottom:2%'>Read Products</a>";
 echo "</div>";

    ?>
    <!-- PHP post code will be here -->
    <?php
// if the form was submitted
if($_POST){

    // set product property values
    $cashier->username = $_POST['name'];
    $cashier->email = $_POST['email'];
    $cashier->password=$_POST['password'];


    // create the product

    if($cashier->createCashier()){

        echo "<div class=container>
        <div class='alert alert-success alert-dismissable'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
          <strong>Cashier Created successfuly succesfuly</strong>
        </div>
      </div>";
          // try to upload the submitted file
// uploadPhoto() method will return an error message, if any.
    }
    }

 ?>
 <!-- HTML form for creating a product -->
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
    <div class="container-fluid">
    <div class="row grid">
    <div class="col-md-9">
    <table class='table table-hover table-responsive-md table-bordered' width=10%>


        <tr>
            <td>Cashier Name</td>
            <td><input type='text' name='name' placeholder="enter name"class='form-control' width='50%' /></td>
        </tr>
            <tr>
            <td>Cashier Email</td>
            <td><input type='email' name='email' placeholder="Enter email address" class='form-control' /></td>
        </tr>
        <tr>
            <td>Cashier Password</td>
            <td><input type='password' name='password' placeholder="Enter password" class='form-control' /></td>
        </tr>
        <tr>
        <td><input type='hidden' name='rights' value='1' class='form-control' width='50%' /></td>
        <tr>
        <td>Action</td>
        <td>
                    <button type="submit" class="btn btn-primary" pull-left>Create</button>
                </td>
        </tr>

    </table>
    </div>
    </div>
    </div>
</form>
