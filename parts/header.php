<?php
$siteName = "OrganicFoods";
$currentPath = basename($_SERVER['PHP_SELF']);
?>

<head>
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  </head>
  
  <script src="https://use.fontawesome.com/1ec13dda20.js"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-style navbar-expand-sm navbar-light ">
    <div class="container">
        <div class"navbar-header">
        <a href=""><img class="logo" src="assets/img/logo.png"></a>
    </div>
        
        <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navmenu"
        >
        <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navmenu">
        <ul class="nbar navbar-nav ms-auto">
            <div class="container-fluid">
            <form class="d-flex" action="search.php" method="post">
                <input class="form-control me-2" type="search" placeholder="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </ul>
        </div>
    </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="index" class="nav-link <?php echo ($currentPath == "index.php") ? "active" : ""; ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li class="nav-item"><a href="catologue" class="nav-link <?php echo ($currentPath == "catologue.php") ? "active" : ""; ?>"><i class="fa fa-book" aria-hidden="true"></i> Catologue</a></li>
            <li class="nav-item"><a href="about" class="nav-link <?php echo ($currentPath == "about.php") ? "active" : ""; ?>"><i class="fa fa-user-circle-o" aria-hidden="true"></i></i> About Us</a></li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle <?php echo ($currentPath != "index" && $currentPath != "catologue.php" && $currentPath != "about.php") ? "active" : ""; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i> My Account</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                    if (isset($_SESSION['usrAuth'])) { ?>
                        <?php
                        if (isset($_SESSION['isAdmin'])) { ?>
                        <a class="dropdown-item" href="admin/dashboard">Admin Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <?php } ?>

                        <?php
                        if (isset($_SESSION['supAuth'])) { ?>
                        <a class="dropdown-item" href="supplier/dashboard">Supplier Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <?php } ?>
                        
                        <a class="dropdown-item" href="account">Manage Account</a>
                        <a class="dropdown-item" href="logout">Logout</a>
                    <?php }else{ ?> 
                        <?php
                        if (isset($_SESSION['supAuth'])) { ?>
                        <a class="dropdown-item" href="supplier/dashboard">Supplier Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <?php } ?>
                        
                        <a class="dropdown-item" href="login">Login</a>
                        <a class="dropdown-item" href="register">Register</a>
                    <?php } ?>
                    
                </div>
            </li>
    
        </ul>
        </div>
    </div>
    </nav>