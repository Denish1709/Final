<?php


include 'config.php';
  

// Product data based on user purchase
$query = "SELECT * FROM user_orders INNER JOIN products on user_orders.product_id = products.id INNER JOIN suppliers on products.posted_by = suppliers.id INNER JOIN users on user_orders.user_id = users.userid WHERE products.posted_by = $supplierId ORDER BY user_orders.id DESC";
$finaldata = mysqli_query($conn, $query);

// check no of data
$result = mysqli_query($conn, "SELECT COUNT(user_orders.id) AS count FROM user_orders INNER JOIN products on user_orders.product_id = products.id INNER JOIN suppliers on products.posted_by = suppliers.id INNER JOIN users on user_orders.user_id = users.userid WHERE products.posted_by = $supplierId ORDER BY user_orders.id DESC");
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
  }elseif($id == 'deleted'){
  echo '<div class="alert alert-success" id="flash-msg">
  <h4><i class="icon fa fa-check "></i> User succesfully removed from system!</h4>
  </div>';
  }
}


?>
<!doctype html>
<html lang="en">
  
<?php $pageTitle = "Order History"; include('includes/header.php');?>

    <section>
        <div class="container p-5">
            <h1>Order History</h1>
            <?php echo "<p> Showing order history for " . $firstname . " $lastname" ."." ."</p>"; ?>
        </div>
    
        <div class="container mb-3">
          <?php if($count == 0){ ?>
            <div class="alert alert-secondary" role="alert">
              There is no purchases for your products.
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
              <?php while($row = mysqli_fetch_assoc($finaldata)) { ?>
                <tr>

                <td><img width="400" src="<?php echo $row ['image_url']; ?>"/></td>

                <td>
                  <p><b>Product Title: </b><?php echo $row ['title']; ?></p>
                  <p><b>Ordered Quantity: </b><?php echo $row ['qtn']; ?></p>
                  <p><b>Customer Paid: </b><?php echo "MYR " . $row ['paid']; ?></p>
                  <p><b>Sold To: </b><?php echo $row ['firstname']." ".$row ['lastname']; ?></p>
                  <div class="dropdown-divider"></div>
                  <p><b>Delivery Method: </b><?php echo $row ['delivery']; ?></p>
                  <p><b>Billing/Shipping Address: </b><?php echo $row ['shipping_address']; ?></p>
                </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <?php } ?>
        </div>

    </section>
    <?php include('includes/footer.php');?>
  </body>
</html>
