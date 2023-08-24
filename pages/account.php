<div class="container">
  <h1 class="mb-4 pb-2"> My Account</h1>
  <p>Welcome to to your account. From here you can view the houses that you have added to your favourites list.</p>
  <p><a class="btn btn-easymove" href="index.php?p=editprofileimage">Edit Profile Image</a></p>

  <h2>Your Profile Picture:</h2>
  <?php
  if($_SESSION['is_staff']) {
    if($_SESSION['user_data']['staffimage']){
      echo '<img class="mb-3" style="max-width: 250px;" src="./user-images/'.$_SESSION['user_data']['staffimage'].'"/>';
    }
  }
  elseif($_SESSION['is_logged_in']){
    if($_SESSION['user_data']['customerimage']){
      echo '<img class="mb-3" style="max-width: 250px;" src="./user-images/'.$_SESSION['user_data']['customerimage'].'"/>';
    }
  }
  ?>
  <div class="row">
    <h2>My Favourites House for Sale:</h2>
    <div class="col-md-12">
      <div class="row">
        <?php
        $Favourite = new Favourite($Conn);
        $houses_for_sale_favs = $Favourite->getAllHouseForSaleFavourites();
        if($houses_for_sale_favs){
          foreach($houses_for_sale_favs as $houses_for_sale_fav) { ?>
            <div class="col-md-3">
              <div class="house-card">
                <div class="house-card-image" style="background-image: url('./sale-images/<?php echo $houses_for_sale_fav['housethumbnail']; ?>')">
                  <a href="index.php?p=houseforsale&id=<?php echo $houses_for_sale_fav['houseforsaleID']; ?>"></a>
                </div>
                <a href="index.php?p=houseforsale&id=<?php echo $houses_for_sale_fav['houseforsaleID']; ?>"><p>
                   <?php echo $houses_for_sale_fav['addressline1'];?>, <?php
                   if($houses_for_sale_fav['addressline2'] != NULL){
                     echo $houses_for_sale_fav['addressline2'];
                   }
                   ?>,<br><?php
                   if($houses_for_sale_fav['addressline3'] != NULL){
                     echo $houses_for_sale_fav['addressline3'];
                   }
                   ?>, <?php
                   if($houses_for_sale_fav['towncity'] != NULL){
                     echo $houses_for_sale_fav['towncity'];
                   }
                   ?>,<br><?php
                   if($houses_for_sale_fav['county'] != NULL){
                     echo $houses_for_sale_fav['county'];
                   }
                   ?>, <?php echo $houses_for_sale_fav['postcode'];?>
                </p></a>
              </div>
            </div>
          <?php }
        }else{
          ?>
          <p>No favourites</p>
        <?php } ?>
      </div>
      <h2>My Favourites House for Sale:</h2>
      <div class="row">
        <?php
        $houses_for_rent_favs = $Favourite->getAllHouseForRentFavourites();
        if($houses_for_rent_favs){
          foreach($houses_for_rent_favs as $houses_for_rent_fav) { ?>
            <div class="col-md-3">
              <div class="house-card">
                <div class="house-card-image" style="background-image: url('./rent-images/<?php echo $houses_for_rent_fav['housethumbnail']; ?>')">
                  <a href="index.php?p=houseforrent&id=<?php echo $houses_for_rent_fav['houseforrentID']; ?>"></a>
                </div>
                <a href="index.php?p=houseforrent&id=<?php echo $houses_for_rent_fav['houseforrentID']; ?>"><p>
                   <?php echo $houses_for_rent_fav['addressline1'];?>, <?php
                   if($houses_for_rent_fav['addressline2'] != NULL){
                     echo $houses_for_rent_fav['addressline2'];
                   }
                   ?>,<br><?php
                   if($houses_for_rent_fav['addressline3'] != NULL){
                     echo $houses_for_rent_fav['addressline3'];
                   }
                   ?>, <?php
                   if($houses_for_rent_fav['towncity'] != NULL){
                     echo $houses_for_rent_fav['towncity'];
                   }
                   ?>,<br><?php
                   if($houses_for_rent_fav['county'] != NULL){
                     echo $houses_for_rent_fav['county'];
                   }
                   ?>, <?php echo $houses_for_rent_fav['postcode'];?>
                </p></a>
              </div>
            </div>
          <?php }
        }else{ ?>
          <p>No favourites</p>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
