<?php

include 'config.php';

if (isset($_SESSION['supAuth'])) {
  session_abort();
  include 'includes/supinfo.php';
}

if (is_null($_SESSION['supAuth'])) {
  header("Location: ../login.php");
}

if ($isAdmin != "1"){
  header("Location: ../account.php?id=unauthorized");
}


//update code
if(isset($_GET['action']))
{
    $action = $_GET['action'];
    if ($action == "read"){
        $id = $_GET['id'];
        $args1 = "UPDATE messages SET IsChecked='1' WHERE id=$id";
        $res1 = mysqli_query($conn, $args1) or die("database error:". mysqli_error($conn));
        if ($res1)
        {
            header("Location: viewinquiries.php?id=updated");
        }
    }elseif($action == "del")
    {
        $id = $_GET['id'];
        $args2 = "DELETE FROM messages where id='$id'";
        $res2 = mysqli_query($conn, $args2) or die("database error:". mysqli_error($conn));
        if($res2)
        {
            header("Location: viewinquiries.php?id=deleted");
        }

    }
}
?>
