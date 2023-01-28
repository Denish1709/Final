<?php
include 'config.php';


$usrAuth = $_SESSION['usrAuth'];

$args = "SELECT * FROM users WHERE email='$usrAuth'";
$result = mysqli_query($conn, $args);
if ($result->num_rows > 0) {
  $row = mysqli_fetch_assoc($result);
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  $email = $row['email'];
  $password = $row['password'];
  $phonenum = $row['phonenum'];
}

//uncomplete edit sqp function
if(isset($_POST['updateFname'])) {
    $newfirstname = $_POST['newFname'];
    if($newfirstname != $firstname) {
      $args = "SELECT * FROM users WHERE firstname='$newfirstname'";
      $result = mysqli_query($conn, $args);
      if (!$result->num_rows > 0){
        $args = "UPDATE users SET firstname='$newfirstname' WHERE email='$usrAuth'";
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
      <h4><i class="icon fa fa-times "></i> Error! Firstname taken!</h4>
      </div>';
      }     
    } else {
      echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
      <h4><i class="icon fa fa-times "></i> Error! Same Username!</h4>
      </div>';
    }
} else {
    if(isset($_POST['updateLname'])) {
        $newlastname = $_POST['newLname'];
        if($newlastname != $lastname) {
            $args = "UPDATE users SET lastname='$newlastname' WHERE email='$usrAuth'";
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
            <h4><i class="icon fa fa-times "></i> Error! Same Username!</h4>
            </div>';
        }
    } else {
        if(isset($_POST['updateEmail'])) {
            $newemail = $_POST['newEmail'];
            if($newemail != $email) {
                $args = "SELECT * FROM users WHERE email='$newemail'";
                $result = mysqli_query($conn, $args);
                if (!$result->num_rows > 0){
                    $args = "UPDATE users SET email='$newemail' WHERE email='$usrAuth'";
                    $result = mysqli_query($conn, $args);
                    if ($result) {
                        session_destroy();
                        header("Location: index.php?id=updated");
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
            if(isset($_POST['updatePassword'])) {
                $newpassword = $_POST['newPass'];
                if($newpassword != $password) {
                    $args = "UPDATE users SET password='$newpassword' WHERE email='$usrAuth'";
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
                    <h4><i class="icon fa fa-times "></i> Error! Same Password!</h4>
                    </div>';
                }
            } else {
                if(isset($_POST['updatePhonenum'])) {
                    $newphonenum = $_POST['newPnum'];
                    if($newphonenum != $phonenum) {
                        $args = "SELECT * FROM users WHERE phonenum='$newphonenum'";
                        $result = mysqli_query($conn, $args);
                        if (!$result->num_rows > 0){
                            $args = "UPDATE users SET phonenum='$newphonenum' WHERE email='$usrAuth'";
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
                        <h4><i class="icon fa fa-times "></i> Error! Phone number taken!</h4>
                        </div>';
                        }     
                    } else {
                    echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
                    <h4><i class="icon fa fa-times "></i> Error! Same Phone Number!</h4>
                    </div>';
                    }
                }
            }
        }
    }
}

?>