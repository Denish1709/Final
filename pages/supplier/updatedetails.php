<?php
include 'config.php';


$usrAuth = $_SESSION['supAuth'];



$sql = "SELECT * FROM users INNER JOIN suppliers ON users.userid=suppliers.id WHERE users.email='$usrAuth'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
  $row = mysqli_fetch_assoc($result);

  //supplier details
  $supplierId = $row['id'];
  $companyName = $row['company_name'];
  $businessPhone = $row['phone_number'];
  $address = $row['address'];
  $businessEmail = $row['email'];
  $foodTypes = $row['food_types'];
} 


if(isset($_POST['updateCompanyName'])) {
    $newCompanyName = $_POST['newCname'];
    if($newCompanyName != $companyName) {
      $args = "SELECT * FROM suppliers WHERE company_name='$newCompanyName'";
      $result = mysqli_query($conn, $args);
      if (!$result->num_rows > 0){
        $args = "UPDATE suppliers SET company_name='$newCompanyName' WHERE id='$supplierId'";
        $result = mysqli_query($conn, $args);
        if ($result) {
          header("Location: details.php?id=updated");
        } else {
          echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
          <h4><i class="icon fa fa-times "></i> Error!</h4>
          </div>';
        }     
      } else {
      echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
      <h4><i class="icon fa fa-times "></i> Error! Company name taken!</h4>
      </div>';
      }     
    } else {
      echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
      <h4><i class="icon fa fa-times "></i> Error! Same Company name!</h4>
      </div>';
    }
} else {
    if(isset($_POST['updateConNum'])) {
        $newContactNum = $_POST['newContactNumber'];
        if($newContactNum != $businessPhone) {
            $args = "UPDATE suppliers SET phone_number='$newContactNum' WHERE id='$supplierId'";
            $result = mysqli_query($conn, $args);
            if ($result) {
                header("Location: details.php?id=updated");
            } else {
                echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
                <h4><i class="icon fa fa-times "></i> Error!</h4>
                </div>';    
            }               
        } else {
            echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
            <h4><i class="icon fa fa-times "></i> Error! Same contact number!</h4>
            </div>';
        }
    } else {
        if(isset($_POST['updateEmail'])) {
            $newemail = $_POST['newEmail'];
            if($newemail != $businessEmail) {
                $args = "SELECT * FROM suppliers WHERE email='$newemail'";
                $result = mysqli_query($conn, $args);
                if (!$result->num_rows > 0){
                    $args = "UPDATE suppliers SET email='$newemail' WHERE id='$supplierId'";
                    $result = mysqli_query($conn, $args);
                    if ($result) {
                        session_destroy();
                        header("Location: login.php");
                    } else {
                        echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
                        <h4><i class="icon fa fa-times "></i> Error!</h4>
                        </div>';
                    }     
                } else {
                echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
                <h4><i class="icon fa fa-times "></i> Error! Email taken!</h4>
                </div>';
                }     
            } else {
            echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
            <h4><i class="icon fa fa-times "></i> Error! Same Email!</h4>
            </div>';
            }
        } else {
            if(isset($_POST['updateAddress'])) {
                $newAddr = $_POST['newAddress'];
                if($newAddr != $address) {
                    $args = "UPDATE suppliers SET address='$newAddr' WHERE id='$supplierId'";
                    $result = mysqli_query($conn, $args);
                    if ($result) {
                        header("Location: details.php?id=updated");

                    } else {
                        echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
                        <h4><i class="icon fa fa-times "></i> Error!</h4>
                        </div>';    
                    }

                } else {
                    echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
                    <h4><i class="icon fa fa-times "></i> Error! Same Address!</h4>
                    </div>';
                }
            } else {
                if(isset($_POST['updateFoodType'])) {
                    $newFoodTypes = $_POST['newTypes'];
                    if($newFoodTypes != $foodTypes) {
            
                        
                        $args = "UPDATE suppliers SET food_types='$newFoodTypes' WHERE id='$supplierId'";
                        $result = mysqli_query($conn, $args);
                        if ($result) {
                            header("Location: details.php?id=updated");

                        } else {
                            echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
                            <h4><i class="icon fa fa-times "></i> Error!</h4>
                            </div>';    
                        }

                        
                    } else {
                    echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
                    <h4><i class="icon fa fa-times "></i> Error! Same Food Types!</h4>
                    </div>';
                    }
                }
            }
        }
    }
}

?>