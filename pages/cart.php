<?php

include 'config.php';
include 'shoppingcart.php';


if (is_null($_SESSION['usrAuth'])) {
  header("Location: catologue.php");
}

?>
<!doctype html>
<html lang="en">
  
<?php $pageTitle = "Cart"; include('./parts/header.php');?>

    <section>

        <div class="container p-5">
            <h1>Your Cart</h1>
            <p>Got all your items in the cart? Check out now and get them delivered to your doorstep!</p>
        </div>
                    
        <div class="container">
        <p>Total Items: <?php echo $cartno; ?> items(s)</p>
        <div class="table-responsive">
          <?php if($cartno == 0){ ?>
            <div class="alert alert-secondary" role="alert">
              Your cart is currently empty.
            </div>
          <?php }else{ ?>  
          <table class="table table-bordered">  
                <tr>  
                    <th >Product ID</th> 
                    <th >Product Title</th>   
                    <th >Price</th>   
                    <th >Quantity</th>                       
                    <th >Remove</th>    
                </tr>  
                <?php   
                if(!empty($_SESSION["shoppingcart"]))  
                {  
                    $total = 0;  
                    foreach($_SESSION["shoppingcart"] as $keys => $values)  
                    {  
                ?>  
                <tr>  
                    <td><?php echo $values["item_id"]; ?></td>  
                    <td><?php echo $values["item_name"]; ?></td> 
                    <td>MYR <?php echo $values["item_price"]; ?></td>  
                    <td><?php echo $values["item_quantity"]; ?></td>  
                    <td><a href="catologue.php?action=delete&id=<?php echo $values["item_id"]; ?>"><input type="button" class="btn btn-outline-danger btn-sm" value="Remove"></input></a></td>  
                </tr>  
                <?php  
                          $total = $total + ($values["item_price"] * $values["item_quantity"]);  
                    }  
                ?>  
                <tr>  
                    <td colspan="4" align="right"><b>Subtotal:</b></td>  
                    <td align="right">MYR <?php echo number_format($total, 2); ?></td>  
                </tr>  

                <tr>  
                    <td colspan="5" align="right"><a href="checkout.php"><input type="button" class="btn btn-success btn-bg" value="Checkout"></td>  
                </tr> 
                <?php } ?>  
          </table>  
          <?php } ?> 
        </div>  




    </section>
    <?php include('./parts/footer.php');?>
  </body>
</html>
