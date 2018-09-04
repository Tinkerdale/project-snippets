<?php
// set page header
$page_title = "Delete Product";
require_once 'C:\xampp\htdocs\GROUP4\layout_head.php';
// retrieve one product will be here
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// include database and object files
require_once 'C:\xampp\htdocs\GROUP4\config\dbconnection.php';
require_once 'C:\xampp\htdocs\GROUP4\Admin\adminproduct.php';
require_once 'C:\xampp\htdocs\GROUP4\Admin\category.php';
// get database connection
$database = new dbConnect();
$db = $database->connect();

// prepare objects
$product = new Products($db);
$category = new Category($db);

// set ID property of product to be deleted
$product->id = $id;

// read the details of product to be deleted
$product->readOne();

?>
<!-- 'update product' form will be here -->
<!-- post code will be here -->
<?php
// if the form was submitted
if($_POST){

    // set product property values
    $product->name = $_POST['name'];
    $product->price = $_POST['price'];
    $product->quantity = $_POST['quantity'];
    $product->description = $_POST['description'];
   // $product->category_id = $_POST['category_id'];

    // update the product
    if($product->delete()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Product was deleted.";
            //header('Location:\mdboot\Allproduct.php');
            header( 'refresh:2;url=AllProducts.php' );

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
 <a href='AllProducts.php' class='btn btn-primary custom-btn pull-right'>Read Products</a>
 </div>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive-md table-bordered'>

        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo $product->name; ?>' class='form-control'readonly /></td>
        </tr>

        <tr>
            <td>Price</td>
            <td><input type='text' name='price' value='<?php echo $product->price; ?>' class='form-control'readonly /></td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td ><input type='' name='quantity' value='<?php echo $product->quantity; ?>' class='form-control' readonly/></td>
        </tr>

        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'readonly><?php echo $product->description; ?></textarea></td>
        </tr>

        <tr>
            <td></td>

            <td>
                <button type="submit" class="btn btn-primary">Delete</button>
            </td>
        </tr>

    </table>

</form>
 <?php



// set page footer
require_once 'C:\xampp\htdocs\GROUP4\layout_foot.php';
?>
