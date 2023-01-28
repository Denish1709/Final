<?php


include '../config.php';

if (isset($_SESSION['usrAuth'])) {
  session_abort();
  include '../usrinfo.php';
}

$args = "SELECT userid, firstname, lastname, phonenum, email, password FROM users";
$result = mysqli_query($conn, $args) or die("database error:". mysqli_error($conn));

if (isset($_POST['deluser'])){
  
  $query = "DELETE FROM users where userid=$id";

  $conn->query($query) or die($conn->error());

  echo header("Location: managemembers.php?id=deleted");

}

if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'invalid'){
    echo '<div class="alert alert-danger" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> Invalid User ID!</h4>
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
  
<?php $pageTitle = "Manage Members"; include('includes/header.php');?>

    <section>
        <div class="container p-5">
            <h1>Manage members</h1>
            <p>Edit or remove members</p>
        </div>
    
        <div class="container mb-3">
        <table id="catalogue" class="table table-bordered">
            <thead>
            <tr>
                <th>Member ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Password</th>
                <th style="width: 10%"><span class="text-nowrap">Actions</span></th>
            </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>

                <td><?php echo $row ['userid']; ?></td>
                <td><?php echo $row ['firstname']; ?></td>
                <td><?php echo $row ['lastname']; ?></td>  
                <td><?php echo $row ['phonenum']; ?></td>  
                <td><?php echo $row ['email']; ?></td>  
                <td>********</td> 

                <td class="col col-sm-1 mb-3"><form method="POST">
                  <a href="edituser.php?id=<?php echo $row ['userid']; ?>"><button type="button" class="btn btn-outline-dark btn-sm" name="">Edit</button></a>
                  <a href="deleteuser.php?id=<?php echo $row ['userid']; ?>"><button type="button" class="btn btn-outline-danger btn-sm" name="">Delete</button></a>
                </td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
        </div>
    </section>
    <?php include('includes/footer.php');?>
  </body>
</html>
