<?php
// connect to database
include 'config/dbconnection.php';

// include objects
include_once "object/product.php";
include_once "object/product_image.php";
include_once "object/cart_item.php";

// connect to database here
// get database connection
$database = new dbConnect();
$db = $database->connect();

// initialize objects
$product = new Product($db);
$product_image = new ProductImage($db);
$cart_item = new CartItem($db);

// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";

// for pagination purposes
$page = isset($_GET['page']) ? $_GET['page'] : 1; // page is the current page, if there's nothing set, default is page 1
$records_per_page = 6; // set records or rows of data per page
$from_record_num = ($records_per_page * $page) - $records_per_page; // calculate for the query LIMIT clause
// set page title
$page_title="Products";

// page header html
require_once 'layout_head.php';
// read all products in the database
$stmt=$product->read($from_record_num, $records_per_page);

// count number of retrieved products
$num = $stmt->rowCount();

// if products retrieved were more than zero
if($num>0){
    // needed for paging
    $page_url="products.php?";
    $total_rows=$product->count();

    // show products
    include_once "read_products.php";
}

// tell the user if there's no products in the database
else{
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-danger'>No products found.</div>";
    echo "</div>";
}


// contents will be here

// layout footer code
require_once 'layout_foot.php';
?>
