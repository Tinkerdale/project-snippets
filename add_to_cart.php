<?php
//require_once "login.php";
session_start();

require_once "object/cart_item.php";
// connect to database
require_once 'config/dbconnection.php';

// get database connection
$database = new dbConnect();
$db = $database->connect();

if(!isset($_SESSION['username'])){

    header("location:loginpage.php");
    // $user=new login(username,password);
    // $user->authenticateUser();

}
if(isset($_SESSION['username'])) {


// parameters
    $product_id = isset($_GET['id']) ? $_GET['id'] : "";
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;

// make quantity a minimum of 1
    $quantity = $quantity <= 0 ? 1 : $quantity;


// include object

// initialize objects
    $cart_item = new CartItem($db);


// set cart item values
    $cart_item->user_id = $_SESSION['username']; // we default to '1' because we do not have logged in user
    $cart_item->product_id = $product_id;
    $cart_item->quantity = $quantity;

// check if the item is in the cart, if it is, do not add
    if ($cart_item->exists()) {
        // redirect to product list and tell the user it was added to cart
        header("Location: cart.php?action=exists");
    } // else, add the item to cart
    else {
        // add to cart
        if ($cart_item->create()) {
            // redirect to product list and tell the user it was added to cart
            header("Location: products.php?id={$product_id}&action=added");
        } else {
            header("Location: products.php?id={$product_id}&action=unable_to_add");
        }

    }

}
