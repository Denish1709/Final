<?php

include 'config.php';
if (is_null($_SESSION['usrAuth'])) {
  header("Location: login.php");
}else{
  include 'usrinfo.php';
}

// Product data based on user purchase
$query = "SELECT *, user_orders.id as pid FROM user_orders INNER JOIN products on user_orders.product_id = products.id INNER JOIN suppliers on products.posted_by = suppliers.id WHERE user_orders.user_id = $userid ORDER BY user_orders.id DESC";
$finaldata = mysqli_query($conn, $query);

// check no of data
$result = mysqli_query($conn, "SELECT COUNT(id) AS count FROM user_orders where user_id = $userid");
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'noauth'){
    echo '<div class="alert alert-danger" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> You must be logged in to make purchases!</h4>
    </div>';
  }elseif($id == 'updated'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> User data succesfully updated!</h4>
    </div>';
  }elseif($id == 'rated'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> You have successfully rated!</h4>
    </div>';
  }elseif($id == 'deleted'){
  echo '<div class="alert alert-success" id="flash-msg">
  <h4><i class="icon fa fa-check "></i> User succesfully removed from system!</h4>
  </div>';
  }
}


?>
<!doctype html>
<html lang="en">
  
<?php $pageTitle = "Order History"; include('./parts/header.php');?>

    <section>
        <div class="container p-5">
            <h1>Purchase History</h1>
            <?php echo "<p> Showing purchase history for " . $firstname . " $lastname" ."." ."</p>"; ?>
        </div>
    
        <div class="container mb-3">
          <?php if($count == 0){ ?>
            <div class="alert alert-secondary" role="alert">
              There is no purchases made in this account.
            </div>
          <?php }else{ ?>
          <table id="catalogue" class="table table-bordered mb-5">
          <thead>
              <tr>
                <th style="width: 25%">Product Image</th>
                <th>Product Information</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = mysqli_fetch_assoc($finaldata)) { 
                // check if rated
                $productId = $row ['pid'];
                $query = "SELECT * FROM supplier_rating WHERE order_id = $productId";
                $result = mysqli_query($conn, $query);
                $rateData = mysqli_fetch_assoc($result);

                if ($result->num_rows > 0){
                  $rated = true;
                }else{
                  $rated = false;
                }
      
                ?>
                <tr>

                <td><img width="400" src="<?php echo $row ['image_url']; ?>"/></td>

                <td>
                  <p><b>Order ID: </b><?php echo $row ['pid']; ?></p>
                  <p><b>Product Title: </b><?php echo $row ['title']; ?></p>
                  <p><b>Ordered Quantity: </b><?php echo $row ['qtn']; ?></p>
                  <p><b>PAID: </b><?php echo "RM " . $row ['paid']; ?></p>
                  <p><b>Sold By: </b><?php echo $row ['company_name']; ?></p>
                  <p><b>Problem with your order? </b><a class="btn btn-dark btn-sm" href="support.php?orderId=<?php echo $row ['pid']; ?>">Report</a></p>
                  <div class="dropdown-divider"></div>
                  <p><b>Delivery Method: </b><?php echo $row ['delivery']; ?></p>
                  <p><b>Billing/Shipping Address: </b><?php echo $row ['shipping_address']; ?></p>
                  <p>
                    <b>Rating: </b>
                    <?php echo ($rated) ? 
                      "You have given (".$rateData['rating']." stars) for this product!":"
                        
                          <form method='post' action='updaterating.php?'>
                            <input type='hidden' name='productId' value='".$row ['pid']."'>
                            <input type='hidden' name='supplierId' value='".$row ['id']."'>
                            <div class='rate'>
                              <input type='submit' id='".$row ['pid']+"5"."' name='rate' value='5' />
                              <label for='".$row ['pid']+"5"."' title='text'>5 stars</label>
                              <input type='submit' id='".$row ['pid']+"4"."' name='rate' value='4' />
                              <label for='".$row ['pid']+"4"."' title='text'>4 stars</label>
                              <input type='submit' id='".$row ['pid']+"3"."' name='rate' value='3' />
                              <label for='".$row ['pid']+"3"."' title='text'>3 stars</label>
                              <input type='submit' id='".$row ['pid']+"2"."' name='rate' value='2' />
                              <label for='".$row ['pid']+"2"."' title='text'>2 stars</label>
                              <input type='submit' id='".$row ['pid']+"1"."' name='rate' value='1' />
                              <label for='".$row ['pid']+"1"."' title='text'>1 star</label>
                            </div>
                          </form>
                        ";?>
                      
                      
                  </p><br>
                </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <?php } ?>
        </div>

    </section>
    <?php include('./parts/footer.php');?>
  </body>
</html>
