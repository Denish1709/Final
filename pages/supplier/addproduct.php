<?php


include '../config.php';

  

if(isset($_POST['addproduct'])) {
  $productImage=$_POST['imageUrl'];
  $productName=$_POST['pName'];
  $productDesc=$_POST['pDesc'];
  $productStocks=$_POST['pStock'];
  $productPrice=$_POST['pPrice'];

  $date = date("Y-m-d");


  $args= "SELECT image_url FROM products WHERE image_url='$productImage'";
  $result = mysqli_query($conn, $args);
  
  if (!$result->num_rows > 0) {
    $args1 = "INSERT INTO products (posted_by, posted_on, title, description, image_url, price, stock) 
    VALUES ('$supplierId', '$date', '$productName', '$productDesc', '$productImage', '$productPrice', '$productStocks')";
    $result1 = mysqli_query($conn, $args1); 
    if ($result1) {

      header( "Location: addproduct.php?id=success" ); die;
      
    } else {
      header( "Location: addproduct.php?id=error1" ); die;
    }

  } else {
    header( "Location: addproduct.php?id=duplicate" ); die;
  }
    
}



if (isset($_GET['id'])){
    $id = $_GET["id"];
    if ($id == 'success'){
        echo '<div class="alert alert-success alert-dismissable" id="flash-msg">
        <h4><i class="icon fa fa-check "></i> Product added successfully!</h4>
        </div>';
    }elseif($id == 'duplicate'){
        echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
        <h4><i class="icon fa fa-times "></i> Error! Product already exists!</h4>
        </div>';    
    }elseif($id == 'error'){
        echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
        <h4><i class="icon fa fa-times "></i> Error!</h4>
        </div>';
    }
  
}

?>
<!doctype html>
<html lang="en">
  
<?php $pageTitle = "Add Product"; include('includes/header.php');?>

    <section>
        <div class="container p-5">
            <h1>Add a new product</h1>
            <p>Input the details of the product to add it into the catalogue</p>
        </div>
    
        <div class="container mb-5">
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="imageUrl" class="col-sm-2 col-form-label">Product Image (URL only)</label>
                  <input type="text" class="form-control" name="imageUrl" required>
                </div>

                <div class="mb-3">
                  <label for="pName" class="col-sm-2 col-form-label">Product Name</label>
                  <input type="text" class="form-control" name="pName" required>
                </div>
                
                <div class="mb-3">
                  <label for="pDesc">Product Description</label>
                  <textarea class="form-control" name="pDesc" rows="3" required></textarea>
                </div>  
                
                <div class="mb-3">
                  <label for="pStock" class="form-label">Product Stock Amount</label>
                  <input type="text" class="form-control" name="pStock" required>
                </div>

                <div class="mb-3">
                  <label for="pPrice" class="form-label">Product Price (RM)</label>
                  <input type="text" class="form-control" name="pPrice" required>
                </div>

                <button type="submit" name="addproduct" class="btn btn-success">Add Product</button>
              </form>
        </div>
      </div>
    </section>
  <?php include('includes/footer.php');?>
</section>
