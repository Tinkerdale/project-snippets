<?php
// connect to database
require_once 'config/dbconnection.php';

// include objects
require_once "object/product.php";
require_once "object/product_image.php";
require_once "object/cart_item.php";

// get database connection
$database = new dbConnect();
$db = $database->connect();

// initialize objects
$product = new Product($db);
$product_image = new ProductImage($db);
$cart_item = new CartItem($db);


// set page title
$page_title="Cart";

// include page header html
require_once 'layout_head.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";

echo "<div class='col-md-12'>";
    if($action=='removed'){
        echo "<div class='alert alert-info'>";
            echo "Product was removed from your cart!";
        echo "</div>";
    }

    else if($action=='quantity_updated'){
        echo "<div class='alert alert-info'>";
            echo "Product quantity was updated!";
        echo "</div>";
    }

    else if($action=='exists'){
        echo "<div class='alert alert-info'>";
            echo "Product already exists in your cart!";
        echo "</div>";
    }

    else if($action=='cart_emptied'){
        echo "<div class='alert alert-info'>";
            echo "Cart was emptied.";
        echo "</div>";
    }

    else if($action=='updated'){
        echo "<div class='alert alert-info'>";
            echo "Quantity was updated.";
        echo "</div>";
    }

    else if($action=='unable_to_update'){
        echo "<div class='alert alert-danger'>";
            echo "Unable to update quantity.";
        echo "</div>";
    }
echo "</div>";
    // $cart_count variable is initialized in navigation.php
if($cart_count>0){

    $cart_item->user_id=$_SESSION['username'];
    $stmt=$cart_item->read();

    $total=0;
    $item_count=0;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $sub_total=$price*$quantity;

        echo "<div class='cart-row'>";
            echo "<div class='col-md-8'>";
                // product name
                echo "<div class='product-name m-b-10px'>";
                    echo "<h4>{$name}</h4>";
                echo "</div>";

                // update quantity
                echo "<form class='update-quantity-form' action='update_quantity.php' method='GET'>";
                    echo "<div class='product-id' style='display:none;'>{$id}</div>";
                    echo "<div class='input-group'>";
                       echo "<input type='hidden' name='id' value='{$id}'/>";
                      echo "<input type='number' name='quantity' value='{$quantity}' class='form-control cart-quantity' min='1' />";
                            echo "<span class='input-group-btn'>";
                                echo "<button class='btn btn-default update-quantity' type='submit'>Update</button>";
                            echo "</span>";
                    echo "</div>";
                echo "</form>";
                    // echo "<div class='product-id' style='display:none;'>{$id}</div>";
                    // echo "<div class='input-group'>";
                    //     echo "<input type='number' name='quantity' value='{$quantity}' class='form-control cart-quantity' min='1' />";
                    //         echo "<span class='input-group-btn'>";
                    //               echo "<a href='update_quantity.php?id={$id}&quantity={$quantity}' class='btn btn-default'>";
                    //                 echo "Update";
                    //               echo "</a>";
                    //         echo "</span>";
                    // echo "</div>";

                // delete from cart
                echo "<a href='remove_from_cart.php?id={$id}' class='btn btn-default'>";
                    echo "Delete";
                echo "</a>";
            echo "</div>";

            echo "<div class='col-md-4'>";
                echo "<h4>Ksh." . number_format($price, 2, '.', ',') . "</h4>";
            echo "</div>";
        echo "</div>";

        $item_count += $quantity;
        $total+=$sub_total;
    }
    echo "<form action='check_out.php' method='get'>";
    echo "<div class='col-md-8'></div>";
    echo "<div class='col-md-4'>";
        echo "<div class='cart-row'>";
            echo "<h4 class='m-b-10px'>Total ({$item_count} items)</h4>";
            echo "<h4>Ksh." . number_format($total, 2, '.', ',') . "</h4>";
            //echo "<a href='check_out.php' class='btn btn-success m-b-10px'>";


echo "<button type='submit' class='btn btn-success m-b-10px' name='checkout'> Proceed to Checkout</button>

</form>";

              //  echo "<span class='glyphicon glyphicon-shopping-cart'></span> Proceed to Checkout";
            //echo "</a>";
        echo "</div>";
    echo "</div>";

}

else{
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-danger'>";
            echo "No products found in your cart!";
        echo "</div>";
    echo "</div>";
}

// layout footer
require_once 'layout_foot.php';


?>
