<?php

include 'shoppingcart.php';
include 'config.php';

$search = $_POST['search'];

$args = "SELECT *, products.id as productId, suppliers.id as supplierId FROM products JOIN suppliers on products.posted_by=suppliers.id WHERE suppliers.isActive = 1 AND products.title LIKE '%$search%'";
$result = mysqli_query($conn, $args) or die("database error:". mysqli_error($conn));

// check no of data
$result1 = mysqli_query($conn, "SELECT COUNT(products.id) AS count FROM products JOIN suppliers on products.posted_by=suppliers.id WHERE suppliers.isActive = 1 AND products.title LIKE '%$search%'");
$check = mysqli_fetch_assoc($result1);
$count = $check['count'];


if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'noauth'){
    echo '<div class="alert alert-danger" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> You must be logged in to make purchases!</h4>
    </div>';
  }elseif($id == 'exist'){
    echo '<div class="alert alert-danger" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> Product exist in cart!</h4>
    </div>';
  }elseif($id == 'deleted'){
  echo '<div class="alert alert-success" id="flash-msg">
  <h4><i class="icon fa fa-check "></i> User succesfully removed from system!</h4>
  </div>';
  }
}

function getAverageRating($supplierId) {
  include 'config.php';
  $query = "SELECT * FROM supplier_rating WHERE supplier_id = $supplierId";
  $resultt = mysqli_query($conn, $query);
  $numberofRating = $resultt->num_rows;
  $totalRating = 0;

  if($numberofRating > 0){
    while($row = mysqli_fetch_assoc($resultt)) {
    $totalRating += $row['rating'];
    $averageRating = round($totalRating / $numberofRating, 1);
  }
  }else{
    $averageRating = 0;
  }
  
  echo $averageRating;
} 


?>
<!doctype html>
<html lang="en">
  
<?php $pageTitle = "Search"; include('./parts/header.php');?>

  <section>
    <div class="container p-5">
        <div class="row g-0">
          <div class="col-sm-6 col-md-8"><h1>Search Result</h1></div>
            <div class="col-6 col-md-4">
              <div class="btn-group dropend pull-right mb-3">
                <a href="cart.php" class="btn btn-success" role="button"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart (<?php echo $cartno; ?>)</a>
                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="checkout.php">Checkout</a>
                </div>
            </div>
          </div>
        </div>
        <p>Showing results for <b><?php echo $search; ?></b></p>
        
    </div>

    <div class="container mb-3">
      <?php if($count == 0){ ?>
        <div class="alert alert-secondary" role="alert">
          No products or items found. Try searching another?
        </div>
      <?php }else{ ?>
      <div class="container mb-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
              <div class="col">
                <div class="card h-100">
                  <img src="<?php echo $row["image_url"]; ?>" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $row ['title']; ?></h5>
                    <p class="card-text"><?php echo $row ['description']; ?></p>
                  </div>
                  <div class="card-footer">

                  <p class="card-text"><i class="fa fa-user-circle-o" aria-hidden="true"></i></i><a href="supplier/profile.php?id=<?php echo $row ['id']; ?>"> <?php echo $row ['company_name']; ?> </a>(<?php getAverageRating($row ['id']); ?> <i class="fa fa-star" aria-hidden="true"></i></i>)</p>

                  

                      <form method="POST" action="shoppingcart.php?action=add&id=<?php echo $row["productId"]; ?>">

                        <div class="row row-cols-3">
                          <p class="cardtext fw-bold"><?php echo 'RM ' . $row ['price']; ?></p>
                          <input class="form-control form-control-sm w-25" type="number" name="chosenQtn" placeholder="0" min="1" max="<?php echo $row ['stock'] ?>">
                          <div>
                            <input type="hidden" name="bookname" value="<?php echo $row["title"]; ?>" />
                            <input type="hidden" name="bookprice" value="<?php echo $row["price"]; ?>" />
                            <?php if(isset($_SESSION["shoppingcart"])){ $item_array_id = array_column($_SESSION["shoppingcart"], "item_id"); if(!in_array($row ['productId'], $item_array_id)){ ?>
                            <button type="submit" class="btn btn-outline-dark btn" name="addcart" ><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                            <?php }else{ ?>
                            <a href="shoppingcart.php?action=delete&id=<?php echo $row["productId"]; ?>"><input type="button" class="btn btn-outline-dark btn" name="removecart" value="Remove"></input></a>
                            <?php } ?>
                            <?php }else{ ?>
                                <button type="submit" class="btn btn-outline-dark btn" name="addcart"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                            <?php } ?>
                              </div>
                          </div>
                      </form>
                   
                  
                </div>
              </div>

              
              </div>
            <?php } ?>
        </div>
      <?php } ?>
    </div>

  </div>


  </section>
<?php include('./parts/footer.php');?>
</body>
</html>
