<?php
// check if value was posted
if($_POST){

    // include database and object file
    require_once 'C:\xampp\htdocs\GROUP4\config\dbconnection.php';
    require_once 'C:\xampp\htdocs\GROUP4\Admin\adminproducts.php';

    // get database connection
    $database = new dbConnect();
    $db = $database->connect();

    // prepare product object
    $product = new Product($db);

    // set product id to be deleted
    $product->id = $_POST['delete-id'];

    // delete the product
    if($product->delete()){
        echo "Object was deleted.";
    }

    // if unable to delete the product
    else{
        echo "Unable to delete object.";
    }
}
?>
