<?php

include 'config.php';

if (isset($_SESSION['usrAuth'])) {
  include 'usrinfo.php';
}else {
  
}


if (empty($_SESSION["shoppingcart"]))
{
  $cartno = 0;
}
else{
  $cartno = count($_SESSION["shoppingcart"]);
}

if(isset($_POST["addcart"])){
  if (isset($_SESSION['usrAuth']))
  {
    if(isset($_SESSION["shoppingcart"]))
    {
      $item_array_id = array_column($_SESSION["shoppingcart"], "item_id");
      if(!in_array($_GET["id"], $item_array_id))
      {
        $count = count($_SESSION["shoppingcart"]);
        $item_array = array(
          'item_id' => $_GET["id"],
          'item_name' => $_POST["bookname"],
          'item_price' => $_POST["bookprice"],
          'item_quantity' => $_POST["chosenQtn"]
        );
        $_SESSION["shoppingcart"][$count] = $item_array;
        header( "Location: catologue.php" );
      }
      else
      {
        header( "Location: catologue.php?id=exist" );
      }
    }
    else
    {
      $item_array = array(
        'item_id' => $_GET["id"],
        'item_name' => $_POST["bookname"],
        'item_price' => $_POST["bookprice"],
        'item_quantity' => $_POST["chosenQtn"]
      );
      $_SESSION["shoppingcart"][0] = $item_array;
      header( "Location: catologue.php" );
    }  
  }else{
    header( "Location: catologue.php?id=noauth" );
  }
}

if(isset($_GET["action"]))  
{  
  if($_GET["action"] == "delete")  
  {  
    foreach($_SESSION["shoppingcart"] as $keys => $values)  
    {  
      if($values["item_id"] == $_GET["id"])  
      {
        unset($_SESSION["shoppingcart"][$keys]);  
        echo '<script>window.location="catologue.php"</script>';  
      }  
    }  
  }  
} 

?>