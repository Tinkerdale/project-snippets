
<?php
// set page header
$page_title = "Exeecute Order";
require_once 'C:\xampp\htdocs\GROUP4\adminlay.php';
// retrieve one product will be here
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// include database and object files
require_once 'C:\xampp\htdocs\GROUP4\config\dbconnection.php';
require_once 'C:\xampp\htdocs\GROUP4\Admin\adminproduct.php';
require_once 'C:\xampp\htdocs\GROUP4\object\order.php';
// get database connection
$database = new dbConnect();
$db = $database->connect();

// prepare objects
$orders = new Order($db);

// set ID property of product to be deleted
$orders->id = $id;

// read the details of product to be deleted
$orders->readOne();

?>
<!-- 'update product' form will be here -->
<!-- post code will be here -->
<?php
// if the form was submitted
if($_POST){

    // set product property values
    $orders->id = $_POST['id'];
   // $product->category_id = $_POST['category_id'];

    // update the product
    if($orders->execute()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Product was executed.";
            //header('Location:\mdboot\Allproduct.php');
            header( 'refresh:2;url=cashier.php' );

        echo "</div>";
    }

    // if unable to update the product, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to delete the product.";
        echo "</div>";
    }
}
?>

<div class='right-button-margin'>
 <a href='cashier.php' class='btn btn-primary custom-btn pull-right'>Read Orders</a>
 </div>

 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
     <table class='table table-hover table-responsive-md table-bordered'>

         <tr>
             <td>ORDER ID</td>
             <td><input type='text' name='id' value='<?php echo $orders->id; ?>' class='form-control'readonly /></td>
         </tr>


         <tr>
             <td>Action</td>

             <td>
                 <button type="submit" class="btn btn-primary">Process</button>
             </td>
         </tr>

     </table>

 </form>
 <?php



// set page footer
require_once 'C:\xampp\htdocs\GROUP4\layout_foot.php';
?>
