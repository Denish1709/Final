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
  
<?php $pageTitle = "Login"; include('./parts/header.php');?>

    <section>
        <div class="container p-5">
            <h1>About Us</h1>
            <p><?php echo $siteName; ?> Agri-Organic Food’s vision is to lead Asia in sustainable organic food and agriculture.</p>

            <p>As Malaysia’s leading producer, distributor and retailer of organic produce, and also a member of International Federation of Organic Farm Movements (IFOAM), <?php echo $siteName; ?> has successfully created a completely certified organic production chain comprising compost factory, organic farms and organic wholesaler certified by National Association for Sustainable Agriculture Australia (NASAA).</p>

            <p><?php echo $siteName; ?> is also certified organic under myOrganic, as accredited by The Department of Agriculture, Malaysia.</p>

            <p>With this vision in mind, <?php echo $siteName; ?> strives to:</p>

            <p>a. Develop and support organic agriculture for the greater good of Mother Earth.</p>
            <p>b. Adopt organic principles pertaining to Health, Ecology, Fairness and Care which in turn supports <?php echo $siteName; ?>’s direction in creating healthier soil, healthier food, healthier people and ultimately a healthier Earth</p>
            <p>c. Commit to producing the highest quality organic food through sustainable farming practices and transparent operations with no adverse effect to consumers’ diet</p>
            <p>d. Build a sustainable organic business to benefit consumers, societies, investors, coworkers, suppliers and all involved</p>
            <p>e. Promote healthier organic and wholesome diet, encourage home cooking which in turn creates happy moments for families across the world</p>
            <p>f. Be on an everyday mission to help our consumers reinvent and ultimately find a healthier version of themselves.</p>

            </p>
        </div>
      </div>
    </section>
    <?php include('./parts/footer.php');?>
  </body>
  


</html>
