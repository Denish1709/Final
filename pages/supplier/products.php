<?php

include '../config.php';


  

// Product data
$args = "SELECT * FROM products";
$productData = mysqli_query($conn, $args) or die("database error:". mysqli_error($conn));

// check no of data
$result = mysqli_query($conn, "SELECT COUNT(id) AS count FROM products where posted_by = $userid");
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

// Product data based on user purchase
$query = "SELECT * FROM products where posted_by = $userid";
$finaldata = mysqli_query($conn, $query);

if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'updated'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> Succesfully updated!</h4>
    </div>';
  }elseif ($id == 'notfound'){
    echo '<div class="alert alert-danger" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> The product is not available!</h4>
    </div>';
  }elseif ($id == 'deleted'){
    echo '<div class="alert alert-danger" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> The product is deleted!</h4>
    </div>';
  }
}


?>
<!doctype html>
<html lang="en">
  
<?php $pageTitle = "My Products"; include('includes/header.php');?>

  <section>
    <div class="container p-5">
      <h1>My Products</h1>
        <div class="form-group">
          <a type="button" href="addproduct.php" class="btn btn-success btn-sm float-right">Add Products</a>
        </div>
    </div>

    <div class="container mb-3">
      <?php if($count == 0){ ?>
        <div class="alert alert-secondary" role="alert">
          You dont have any products listed.
        </div>
      <?php }else{ ?>
      <table id="catalogue" class="table table-bordered mb-5">
        <thead>
          <tr>
            <th style="width: 25%">Product Image</th>
            <th>Product Information</th>
            <th><span class="text-nowrap">Actions</span></th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($finaldata)) { ?>
            <tr>

            <td><img width="400" src="<?php echo $row ['image_url']; ?>"/></td>

            <td>
              <p><b>Product ID: </b><?php echo $row ['id']; ?></p>
              <p><b>Product Title: </b><?php echo $row ['title']; ?></p>
              <p><b>Product Description: </b><?php echo $row ['description']; ?></p>
              <p><b>Product Price: </b>RM <?php echo $row ['price']; ?></p>
              <p><b>Product Stock Quantity: </b><?php echo $row ['stock']; ?></p>
            </td>


            <td class="col col-sm-1">
              <a href="editproduct.php?id=<?php echo $row ['id']; ?>"><input type="submit" class="btn btn-outline-dark btn-sm" name="book" value="Manage"></input></a>
            </td>

            </tr>
          <?php } ?>
        </tbody>
      </table>
      <?php } ?>
    </div>




  </div>


  </section>
    <?php include('includes/footer.php');?>
    </body>
</html>
