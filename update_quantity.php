<?php
// get the product id
    $product_id = isset($_GET['id']) ? $_GET['id'] : 0;
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;



// make quantity a minimum of 1
    // $quantity = $quantity > 0 ? $quantity : 1;


// connect to database
    require_once 'config/dbconnection.php';
// include object
    require_once "object/cart_item.php";

// get database connection
    $database = new dbconnect();
    $db = $database->connect();

// initialize objects
    $cart_item = new CartItem($db);

// set cart item values
    // $cart_item->user_id = $_SESSION['username']; // we default to '1' because we do not have logged in user


    // $cart_item->product_id = 42;
    // $cart_item->quantity = 3;

// increase the number of quantity in the  cart

    if ($cart_item->update($product_id, $quantity,'elvis')) {
        // redirect to product list and tell the user it was added to cart
        header("Location: cart.php?action=updated");
    } else {
        header("Location: cart.php?action=unable_to_update");
    }
require_once "layout_foot.php";
?>
