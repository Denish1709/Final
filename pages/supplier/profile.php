<?php

// if (is_null($_SESSION['supAuth'])) {
//   header("Location: login.php");
// }else{
//   //include '../usrinfo.php';
//   include 'includes/supinfo.php';
// }

include 'config.php';

if (isset($_GET['id'])){
  $id = $_GET["id"];
  if (empty($id)){
    echo '<div class="alert alert-danger" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> Invalid Product!</h4>
    </div>';
  }else{
    $argument = "SELECT id from suppliers where id = $id";
    $verify = mysqli_query($conn, $argument) or die("database error:". mysqli_error($conn));

    $row = mysqli_fetch_assoc($verify);
    $check = $row["id"];

    if($id == $check){
      $args = "SELECT * FROM suppliers WHERE id='$id'";
      $result = mysqli_query($conn, $args) or die("database error:". mysqli_error($conn));
    }else{
      ;
    }
  }
  
  
}

$sql = "SELECT * FROM suppliers WHERE id='$id'";
$result = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));


$row = mysqli_fetch_assoc($result);
function getAverageRating($supplierId) {
  include 'config.php';
  $query = "SELECT * FROM supplier_rating WHERE supplier_id = $supplierId";
  $result = mysqli_query($conn, $query);
  $numberofRating = $result->num_rows;
  $totalRating = 0;
  while($row = mysqli_fetch_assoc($result)) {
    $totalRating += $row['rating'];
    $averageRating = round($totalRating / $numberofRating, 1);
  }
  echo $averageRating;
} 
?>

<!doctype html>
<html lang="en">
  
<?php $pageTitle = "Supplier Details"; include('includes/header.php');?>

    <section>
        <div class="container p-5">
            <h1><?php echo $row['company_name']?> (<?php getAverageRating($row ['id']); ?><i class="fa fa-star" aria-hidden="true"></i></i>)</h1>
            <p>Registered supplier since <?php echo $row['registered_on']?></p>
        </div>

        <div class="container" id="group">
          <table class="table table-sm">
            <tbody>
              <tr>
                <th scope="row">Contact Number:</th>
                <td><?php echo "<p>". $row['phone_number']."</p>"; ?></td>
              </tr>
              <tr>
                <th scope="row">Business Email:</th>
                <td><?php echo "<p>". $row['email']."</p>"; ?></td>
              </tr>
              <tr>
                <th scope="row">Business Location:</th>
                <td><?php echo "<p>". $row['address']."</p>"; ?></td>
              </tr>
              <tr>
                <th scope="row">Preferred Types of Food:</th>
                <td><?php echo "<p>". $row['food_types']."</p>"; ?></td>
              </tr>
            </tbody>
          </table>
        </div>





        
      </div>
    </section>
    <?php include('includes/footer.php');?>
  </body>
</html>
