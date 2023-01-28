<?php

include '../config.php';

if (isset($_SESSION['usrAuth'])) {
  session_abort();
  include '../usrinfo.php';
}

if (is_null($_SESSION['usrAuth'])) {
  header("Location: ../login.php");
}

if ($isAdmin != "1"){
  header("Location: ../account.php?id=unauthorized");
}

// check no of data
$result = mysqli_query($conn, "SELECT COUNT(id) AS count FROM passwordreset");
$row = mysqli_fetch_assoc($result);
$count = $row['count'];


// request data
$args = "SELECT * FROM passwordreset JOIN users ON (passwordreset.userid = users.userid)";
$result = mysqli_query($conn, $args) or die("database error:". mysqli_error($conn));

//approve code


// reject code
if (isset($_POST['reject'])){
  
  $query = "DELETE FROM passwordreset where userid=$id";

  $conn->query($query) or die($conn->error());

  echo '<div class="alert alert-success" id="flash-msg">
  <h4><i class="icon fa fa-check "></i> Request succesfully removed from system!</h4>
  </div>';

}

if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'approved'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> Request approved and password has been changed!</h4>
    </div>';
  }elseif($id == 'rejected'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> Request rejected and password has not been changed!</h4>
    </div>';
  }
}


?>
<!doctype html>
<html lang="en">
  
<?php $pageTitle = "Password Request"; include('includes/header.php');?>

    <section>
        <div class="container p-5">
            <h1>Manage password reset requests</h1>
            <p>Approve or Reject password reset requests sent by customers.</p>
        </div>
    
        <div class="container mb-3">
          <?php if($count == 0){ ?>
            <div class="alert alert-secondary" role="alert">
              There is no pending password reset request.
            </div>
          <?php }else{ ?>
          <table id="catalogue" class="table table-bordered">
              <thead>
              <tr>
                  <th>Member ID</th>
                  <th>First Name</th>
                  <th>Current Password</th>
                  <th>New Password</th>
                  <th>Select:</th>
              </tr>
              </thead>
              <tbody>
              <?php while($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>

                  <td><?php echo $row ['userid']; ?></td>
                  <td><?php echo $row ['firstname']; ?></td>
                  <td><?php echo $row ['cpassword']; ?></td>
                  <td><?php echo $row ['npassword']; ?></td>  

                  <td class="col col-sm-1 mb-3" style="white-space: nowrap;"><form method="POST">
                    <a href="approverequest.php?id=<?php echo $row ['userid']; ?>"><button type="button" class="btn btn-outline-dark btn-sm" name="approvebtn">Approve</button></a>
                    <a href="rejectrequest.php?id=<?php echo $row ['userid']; ?>"><button type="button" class="btn btn-outline-danger btn-sm" name="reject">Reject</button></a>
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
