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
    $orders = new Order($db);

    // set product id to be deleted
    $orders->id = $_POST['id'];

    // delete the product
    if($product->delete()){
        echo "order has been processed succesfully.";
    }

    // if unable to delete the product
    else{
        echo "Unable to process the order";
    }
}
?>
