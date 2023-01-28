<?php

// include 'config.php';

if(isset($_POST['submitask'])) {
  $name = $_POST['uname'];
  $email = $_POST['uemail'];
  $message = $_POST['message'];

  $args = "INSERT INTO messages (name, email, message, IsChecked)
      VALUES ('$name', '$email', '$message','0')";

  $result = mysqli_query($conn, $args);
  if ($result) {
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> Succesfully submitted!</h4>
    </div>';
  } else {
    echo '<div class="alert alert-danger" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> Error!</h4>
    </div>';
  }
  
}

if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'updated'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> Details succesfully updated! Please login again!</h4>
    </div>';
  }
}

?>

<!doctype html>
<html lang="en">

<?php $pageTitle = "Home"; include('./parts/header.php');?>

<body>
  <section class="home text-dark p-5 text-left">

    <div class="container">
      <div class="d-sm-flex align-items-center justify-content-between">
        <div>
          <h1>Fresh Groceries, Everywhere</h1>
          <p class="lead my-4">Get your organic food & snacks supply from Malaysia's best online organic food store.</p>
          <p>Browse & buy your organic food here!</p>
          <a href="catologue.php"><button class="btn btn-outline-dark btn-lg"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Browse <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button></a>         
        </div>
        <img class="img-fluid w-50 d-none d-sm-block" src="assets/img/landing.png">

      </div>
    </div>
  </section>



  <section class="bg-dark pt-5 pb-5">  
  <div class="container text-center" id="whyus">
    <div id="h1">
      <h1>Why Us?</h1>
    </div>

    <div class="row d-flex justify-content-around">

      <div class="col">
        <div class="card" style="width: 24rem; height: 14rem;">
          <div class="card-body">
            <h1 class="card-title"><i class="fa fa-tree" aria-hidden="true"></i></h1>
            <h5 class="card-title">Harvested Daily</h5>
            <p class="card-text">All of our crops are harvested daily by experienced farmers across the globe.</p>
          </div>
        </div>
      </div>

      <div class="col">
      <div class="card" style="width: 24rem; height: 14rem;">
          <div class="card-body">
            <h1 class="card-title"><i class="fa fa-money" aria-hidden="true"></i></h1>
            <h5 class="card-title">Affordable</h5>
            <p class="card-text">Vegetable, herbs, fruits, and many more at the most affordable cost.<br> Free delivery nationwide!</p>
          </div>
        </div>
      </div>

      <div class="col">
      <div class="card" style="width: 24rem; height: 14rem;">
          <div class="card-body">
            <h1 class="card-title"><i class="fa fa-tint" aria-hidden="true"></i></h1>
            <h5 class="card-title">No Preservaties</h5>
            <p class="card-text">All of our products are full of only natural, organic ingredients. Every product is frozen while fresh, enabling us to retain in the fresh flavor while staying preservative free. </p>
          </div>
        </div>
      </div>

    </div>
  </div>
  </section>  


  <section class="pt-5 pb-5" id="contact">
    <div class="container align-items-center text-center mb-3">
      <h1>Have Questions?</h1>

      <div class="container-fluid mb-3" style="max-width: 500px;">
            <form action="" method="POST">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" placeholder="Name" name="uname" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" placeholder="Email" name="uemail" required>
                </div>   
                <div class="mb-3">
                  <label for="message">Inquiries</label>
                  <textarea class="form-control" name="message" rows="3" placeholder="Type your message here..." required></textarea>
                </div>          
                <button type="submit" name="submitask" class="btn btn-primary">Ask!</button>
              </form>
        </div>
      </div>





    </div>
  </section>
</body>


<!-- Footer -->
<?php include('./parts/footer.php');?>
</html>
