<?php


if (is_null($_SESSION['usrAuth'])) {
  header("Location: login.php");
}else {
  include 'usrinfo.php';
}

header('Refresh: 5; URL=orderhistory.php');

if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'success'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> Inquiry succesfully submitted!</h4>
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
  
<?php $pageTitle = "Thank You!"; include('./parts/header.php');?>

    <!---->
    <section>
        <div class="container p-5">
            <h1>Thank you!</h1>

            <div class="container">
            <p>We at <?php echo $siteName; ?> truly appreciate your purchase, and we’re so grateful for the trust you’ve placed in us. We sincerely hope you are satisfied with your purchase.</p>
            <p>You'll be automatically redirect to your orders page in 5 seconds.</p>
            <p>If you're not redirected in 5 seconds... <a href="orderhistory.php">click here</a> to proceed.</p>
        </div>
    
    </section>
  <?php include('./parts/footer.php');?>
  </body>

</html>
