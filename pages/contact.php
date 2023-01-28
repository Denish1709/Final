<?php


if (isset($_SESSION['usrAuth'])) {
  session_abort();
  include 'usrinfo.php';
}
if(isset($_POST['submitform'])) {
  if(empty($firstname) && empty($email)){
    include 'config.php';
    $name = $_POST['uname'];
    $email = $_POST['uemail'];
  }else{
    $name = $firstname . " " . $lastname;
  }
  $message = $_POST['message'];

  $args = "INSERT INTO messages (name, email, message, IsChecked)
      VALUES ('$name', '$email', '$message','0')";

  $result = mysqli_query($conn, $args);
  if ($result) {
    header( "Location: contact.php?id=success" ); die;
  } else {
    echo 'something error';
  }
  
}

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
  
<?php $pageTitle = "Contact Us"; include('./parts/header.php');?>

    <section>
        <div class="container p-5">
            <h1>Get Help!</h1>
            <p>Got questions or unsatisfied with our services? Report them to us here! We'll get back to you soon!</p>
        </div>
    
        <div class="container-fluid mb-3" style="max-width: 500px;">
            <form action="" method="POST">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" name="uname" value="<?php if(empty(isset($_SESSION['usrAuth']))) { echo ''; }else{ echo $firstname . " " . $lastname; } ?>" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="uemail" value="<?php if(empty(isset($_SESSION['usrAuth']))) { echo ''; }else{ echo $email; } ?>" required>
                </div>   
                <div class="mb-3">
                  <label for="message">Inquiries</label>
                  <textarea class="form-control" name="message" rows="3" placeholder="Type your message here..." required></textarea>
                </div>      
                <p>Note: For inquires about orders, please include your Order ID in the message.</p>    
                <button type="submit" name="submitform" class="btn btn-primary">Ask!</button>
              </form>
        </div>
      </div>
      
    </section>
    <?php include('./parts/footer.php');?>
  </body>
 


</html>
