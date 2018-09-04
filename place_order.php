<?php

  //  session_destroy();
session_start();

//    if (!isset($_SESSION['username'])) {
//
//        header("location:loginpage.php");
//    } else {
        //$now = date('Y-m-d H:i:s');
        // get database connection

        require_once "config/dbconnection.php";
        $database = new dbConnect();
        $db = $database->connect();

//                $update_user_id = "UPDATE cafe_db.cart_items SET user_id= ? where created < NOW()";
//                $runupdate = $db->prepare($update_user_id);
//                $runupdate->execute([$_SESSION['username']]);

// include classes

        require_once "object/cart_item.php";
        require_once "object/order.php";




// initialize objects
        $cart_item = new CartItem($db);
        $order_item = new Order($db);

// remove all cart item by user, from database
        $cart_item->user_id = ($_SESSION['username']);
        $order_item->createOrder();
// we default to '1' because we do not have logged in user
        $cart_item->deleteByUser();

// set page title
        $page_title = "Thank You!";

// include page header HTML
        require_once 'layout_head.php';

        echo "<div class='col-md-12'>";
        // tell the user order has been placed
        echo "<div class='alert alert-success'>";
        echo "<strong>Your order has been placed!</strong> Thank you very much!";
        echo "</div>";
        echo "</div>";

// include page footer HTML
        require_once 'layout_foot.php';


