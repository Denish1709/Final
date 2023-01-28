<?php

include '../usrinfo.php';

if (is_null($_SESSION['supAuth'])) {
  header("Location: ../login.php");
}elseif (is_null($_GET['id'])){
    header("Location: products.php?id=notfound");
}


if (isset($_GET['id'])){
  $id = $_GET["id"];
  $args = "SELECT * FROM products where id=$id";
  $result = mysqli_query($conn, $args) or die("database error:". mysqli_error($conn));

  $row = mysqli_fetch_assoc($result);

  if(isset($_POST['savedata'])){

      $ntitle=$_POST['title'];
      $ndesc=$_POST['description'];
      $nprice=$_POST['price'];
      $nstock=$_POST['stock'];

      $savequery = "UPDATE products SET title='$ntitle', description='$ndesc', price='$nprice', stock='$nstock' WHERE id=$id";
      // $updatepurchase = "UPDATE user_orders SET id='$id' WHERE bookid=$id";

      $result = mysqli_query($conn, $savequery) or die("database error:". mysqli_error($conn));
      if($result){
        echo header("Location: products.php?id=updated");
      }

      
  }elseif(isset($_POST['deldata'])){
      $delquery = "DELETE FROM products where id=$id";

      $result = mysqli_query($conn, $delquery) or die("database error:". mysqli_error($conn));
      if($result){
        echo header("Location: products.php?id=deleted");
      }

      
  }elseif(isset($_POST['discarddata'])){
      echo header("Location: products.php");
  }
}

?>
<!doctype html>
<html lang="en">
  
<?php $pageTitle = "Login"; include('includes/header.php');?>

    <section>
        <div class="container p-5">
            <h1>Edit Product Details</h1>
            <p>Currently Editing: <?php echo $row ['title']; ?></p>
        </div>
    
        <div class="container">
            <form action="" method="POST">

              <div class="form-group row mb-3">
                <label for="image_url" class="col-sm-2 col-form-label">Product Image URL</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="image_url" value="<?php echo $row ['image_url']; ?>" required>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="title" class="col-sm-2 col-form-label">Product Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" value="<?php echo $row ['title']; ?>" required>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Product Description</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="description" value="<?php echo $row ['description']; ?>" required>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="price" class="col-sm-2 col-form-label">Product Price (MYR)</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="price"><?php echo $row ['price']; ?></textarea>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="stock" class="col-sm-2 col-form-label">Stock Quantity</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="stock" value="<?php echo $row ['stock']; ?>" required>
                </div>
              </div>


              <div class="form-group row mb-3">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-success" name="savedata">Save</button>
                  <button type="submit" class="btn btn-outline-primary" name="discarddata">Discard</button>
                  <button type="submit" class="btn btn-outline-danger" name="deldata">Delete</button>
                </div>
              </div>
            </form>
        </div>
      </div>
    </section>
  </body>

  <?php include('includes/footer.php');?>
  </body>
</html>
