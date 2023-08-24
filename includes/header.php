<!DOCTYPE html>
<html>

  <head>
    <title>EasyMove - The Easiest Way to Buy or Rent Houses</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css\styles.css">
    <script src="node_modules\jquery\dist\jquery.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="https://benjaminpernot.uosweb.co.uk/EasyMove/favicon.ico" />
    <script src="https://kit.fontawesome.com/66d303bbbb.js" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjE_4CM_tARfkzEyv3CEWglyiZG1ANClw&callback=initMap&libraries=&v=weekly"defer></script>
  </head>

  <body id="page-<?php echo $page; ?>">
    <header>
      <div class="page-header-top container text-center text-md-left">
        <a href="index.php?p=home"><img src="./images/EasyMoveLogo.PNG" alt="EasyMove" /></a>
      </div>
      <nav class="navbar navbar-expand-lg mb-4">
        <div class="container">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php?p=home">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Browse Houses
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="nav-link" href="index.php?p=viewhouseforsale">For Sale</a>
                  <div class="dropdown-divider"></div>
                  <a class="nav-link" href="index.php?p=viewhouseforrent">For Rent</a>
                </div>
              </li>
              <?php
              if($_SESSION['is_logged_in']){
                if($_SESSION['is_staff']) { ?>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Add Houses
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="nav-link" href="index.php?p=addhouseforsale">For Sale</a>
                      <div class="dropdown-divider"></div>
                      <a class="nav-link" href="index.php?p=addhouseforrent">For Rent</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?p=staffregister">Register Staff</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      View Lists
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="nav-link" href="index.php?p=viewvalidationappointments">View Appointments</a>
                      <div class="dropdown-divider"></div>
                      <a class="nav-link" href="index.php?p=viewcontactlist">View Customers to Contact</a>
                    </div>
                  </li>
                <?php } ?>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?p=bookvalidationappointments">Book Appointments</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['user_data']['firstname'] ?> <?php echo $_SESSION['user_data']['lastname'] ?>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="nav-link" href="index.php?p=account">My Account</a>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link" href="index.php?p=logout">Logout</a>
                  </div>
                </li>
              <?php } else { ?>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?p=login">Login / Register</a>
                  </li>
              <?php } ?>
            </ul>

            <form action="index.php?p=search" method="post" class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="text" name="query" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
            </form>

          </div>
        </div>
      </nav>
    </header>
