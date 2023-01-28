<?php
// add empty and say no results

include 'config.php';
  

// check no of data
$result = mysqli_query($conn, "SELECT COUNT(messages.id) AS count FROM messages INNER JOIN user_orders on messages.orderID = user_orders.id INNER JOIN products on user_orders.product_id=products.id WHERE products.posted_by = $supplierId");
$row = mysqli_fetch_assoc($result);
$count = $row['count'];


// request data
$args = "SELECT * , messages.id as messagesId FROM messages INNER JOIN user_orders on messages.orderID = user_orders.id INNER JOIN products on user_orders.product_id=products.id WHERE products.posted_by = $supplierId";
$result = mysqli_query($conn, $args) or die("database error:". mysqli_error($conn));


if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'updated'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> Status updated!</h4>
    </div>';
  }elseif($id == 'deleted'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> Inquiry deleted!</h4>
    </div>';
  }
}


?>
<!doctype html>
<html lang="en">
  
<?php $pageTitle = "View Inquiries"; include('includes/header.php');?>

    <section>
        <div class="container p-5">
            <h1>Manage inquiries</h1>
            <p>View inquiries sent by guests and customers</p>
        </div>
    
        <div class="container mb-3">
          <?php if($count == 0){ ?>
            <div class="alert alert-secondary" role="alert">
              There is no pending inquiries.
            </div>
          <?php }else{ ?>
          <table id="catalogue" class="table table-bordered">
              <thead>
              <tr>
                  <th>First Name</th>
                  <th>Email</th>
                  <th>Order ID</th>
                  <th>Message</th>
                  <th><span class="text-nowrap">Status</span></th>
                  <th><span class="text-nowrap">Action</span></th>
              </tr>
              </thead>
              <tbody>
              <?php while($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>

                  <td><span class="text-nowrap"><?php echo $row ['name']; ?></span></td>
                  <td><?php echo $row ['email']; ?></td>
                  <td><?php echo $row ['orderId']; ?></td>
                  <td><?php echo $row ['message']; ?></td>
                  <td><span class="text-nowrap"><?php echo ($row ['IsChecked']) ? '<i class="fa fa-check" aria-hidden="true"></i> Read':'<i class="fa fa-times" aria-hidden="true"></i> Unread'; ?></span></td>

                  <td class="col col-sm-1 mb-3" style="white-space: nowrap;"><form method="POST">
                    <?php if(($row ['IsChecked']) == "0"){ ?>
                    <a href="updatestatus.php?id=<?php echo $row ['messagesId']; ?>&action=read"><button type="button" class="btn btn-outline-dark btn-sm" name="approvebtn">Mark as read</button></a>
                    <?php } ?>
                    <a href="updatestatus.php?id=<?php echo $row ['messagesId']; ?>&action=del"><button type="button" class="btn btn-outline-danger btn-sm" name="reject">Delete</button></a>
                    
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
