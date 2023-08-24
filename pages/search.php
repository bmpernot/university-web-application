<?php
  $House = new Search($Conn);
  $housesforsale = $House->searchHousesForSale($_POST['query']);
  $housesforrent = $House->searchHousesForRent($_POST['query']);
?>

<div class="container">
  <h1 class="mb-4 pb-2">Search Results for "<?php echo $_POST['query'];?>"</h1>
  <div class="row">
    <?php foreach($housesforsale as $houseforsale) { ?>
    <div class="col-md-3">
      <div class="house-card">
        <div class="house-card-image" style="background-image: url('./sale-images/<?php echo $houseforsale['housethumbnail']; ?>')">
          <a href="index.php?p=houseforsale&id=<?php echo $houseforsale['houseforsaleID']; ?>"></a>
        </div>
        <a href="index.php?p=houseforsale&id=<?php echo $houseforsale['houseforsaleID']; ?>"><p>
           <?php echo $houseforsale['addressline1'];?>, <?php
           if($houseforsale['addressline2'] != NULL){
             echo $houseforsale['addressline2'];?>,<br><?php
           }
           if($houseforsale['addressline3'] != NULL){
             echo $houseforsale['addressline3'];?>, <?php
           }
           if($houseforsale['towncity'] != NULL){
             echo $houseforsale['towncity'];?>,<br><?php
           }
           if($houseforsale['county'] != NULL){
             echo $houseforsale['county'];?>, <?php
           }
           echo $houseforsale['postcode'];?>
        </p></a>
      </div>
    </div>
    <?php }
    foreach($housesforrent as $houseforrent) {?>
      <div class="col-md-3">
        <div class="house-card">
          <div class="house-card-image" style="background-image: url('./rent-images/<?php echo $houseforrent['housethumbnail']; ?>')">
            <a href="index.php?p=houseforrent&id=<?php echo $houseforrent['houseforrentID']; ?>"></a>
          </div>
          <a href="index.php?p=houseforrent&id=<?php echo $houseforrent['houseforrentID']; ?>"><p>
             <?php echo $houseforrent['addressline1'];?>, <?php
             if($houseforrent['addressline2'] != NULL){
               echo $houseforrent['addressline2'];?>,<br><?php
             }
             if($houseforrent['addressline3'] != NULL){
               echo $houseforrent['addressline3'];?>, <?php
             }
             if($houseforrent['towncity'] != NULL){
               echo $houseforrent['towncity'];?>,<br><?php
             }
             if($houseforrent['county'] != NULL){
               echo $houseforrent['county'];?>, <?php
             }
             echo $houseforrent['postcode'];?>
          </p></a>
        </div>
    </div>
  <?php } ?>
  </div>
</div>
