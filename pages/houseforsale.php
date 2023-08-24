<?php
$House = new House ($Conn);
$house_data = $House->getHouseForSale($_GET['id']);
$house_images = $House->getHouseForSaleImages($_GET['id']);
?>

<div class="container">
  <?php
  if($_POST){
    $ContactList = new Contact_List($Conn);
    $attempt = $ContactList->addToSaleContactList($_POST);

    if($attempt) {
      ?>
      <div class="alert alert-success" role="alert">
        A member of staff will contact you shortly about this house.
      </div>
      <?php
    }else{
      ?>
      <div class="alert alert-danger" role="alert">
        An error occurred, please try again later.
      </div>
      <?php
    }
  }
  ?>
  <div class="row">
    <div class="col-md-6">
      <?php if($house_images) { ?>
        <div class="row">
          <div class="glide">
            <div class="glide__track" data-glide-el="track">
              <ul class="glide__slides">
                <!-- may not work -->
                <?php foreach($house_images as $house_image) { ?>
                  <li class="glide__slide"><img src="./sale-images/<?php echo $house_image['image']; ?>" alt=""></img></li>
                <?php } ?>
                <!-- may not work -->
              </ul>
            </div>
            <div class="glide__arrows" data-glide-el="controls">
              <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
                <i class="fas fa-backward"></i></i>
              </button>
              <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
                <i class="fas fa-forward"></i></i>
              </button>
            </div>
          </div>
        </div>
      <?php }else{ ?>
        <h3>No photos avaiable</h3>
      <?php } ?>
      <h3>Location</h3>
      <div id="map"></div>
    </div>

    <div class="col-md-6">
      <h3>Property Address</h3>
      <p><?php echo $house_data['addressline1'];?>, <?php
      if($house_data['addressline2'] != NULL){
        echo $house_data['addressline2'];?>,<br><?php
      }
      if($house_data['addressline3'] != NULL){
        echo $house_data['addressline3'];?>, <?php
      }
      if($house_data['towncity'] != NULL){
        echo $house_data['towncity'];?>,<br><?php
      }
      if($house_data['county'] != NULL){
        echo $house_data['county'];?>, <?php
      }
      echo $house_data['postcode'];?>
      </p>
      <h3>Property Features</h3>
      <ul class="house-features">
        <li>Property Type: <?php echo $house_data['propertytype'];?></li>
        <li><i class="fas fa-pound-sign"></i> <?php echo $house_data['resaleprice']; ?></li>
        <li>Bedrooms: <?php echo $house_data['bedrooms']; ?></li>
        <li>Bathrooms: <?php echo $house_data['bathrooms']; ?></li>
        <li>Garden Size: <?php echo $house_data['gardensize']; ?> Acres</li>
        <li>Garage: <?php if($house_data['garage'] == 0){echo "No";}else{echo "Yes";} ?></li>
        <li>New or Resale: <?php if($house_data['new'] == true){echo "New";} else {echo "Resale";} ?></li>
        <li>Needs Modernisation: <?php if($house_data['needmodernisation'] == true){echo "Yes";} else{echo "No";} ?></li>
        <li>Date added: <?php echo $house_data['dateadded'] ?></li>
      </ul>
      <h3>Property Description</h3>
      <p><?php echo $house_data['propertydescription']; ?></p>

      <h3>Property Layout</h3>
      <?php if($house_data['layout']){ ?>
        <img src="./rent-images/<?php echo $house_data['layout']; ?>" alt=""></img>
      <?php } else {?>
        <p>There is no layout of the house</p>
      <?php } ?>

      <?php
      if(!$_SESSION['is_logged_in']) {
        ?>
          <p>Unfortunately, only registerd users can leave favourite houses.</p>
        <?php
      }elseif($_SESSION['is_staff']) {
        ?>
          <p>Unfortunately, members of staff cannot have favourite houses.</p>
        <?php
      }else{

      $Favourite = new Favourite($Conn);
      $is_fav = $Favourite->isHouseForSaleFavourite($_GET['id']);

      if($is_fav) { ?>
          <button id="removeFav" type="button" class="btn btn-easymove mb-3" data-type="sale" data-id="<?php echo $_GET['id']; ?>">Remove from favourites</button>
      <?php }else{ ?>
          <button id="addFav" type="button" class="btn btn-easymove mb-3" data-type="sale" data-id="<?php echo $_GET['id']; ?>">Add to favourites</button>
        <?php }
      } ?>

      <?php
      if(!$_SESSION['is_logged_in']) {
        ?>
          <p>Unfortunately, only registerd users can get more information about the houses.</p>
        <?php
      }elseif($_SESSION['is_staff']) {
        ?>
          <p>Unfortunately, members of staff cannot get more information about the houses.</p>
        <?php
      }else{ ?>
        <form id="contact_list" method="post" action="">
          <input type="hidden" id="houseforsaleID" name="houseforsaleID" value="<?php echo $_GET['id']?>">
          <button type="submit" class="btn btn-easymove">Get staff to contact you with more details</button>
        </form>
      <?php } ?>
    </div>
  </div>
</div>

<script src="node_modules/@glidejs/glide/dist/glide.min.js"></script>

<script>
  const config = {
    type: 'carousel',
    startAt: 0,
    perView: 3,
    autoplay: 3000,
    hoverpause: true,
    keyboard: true,
    swipeThreshold: 20,
    breakpoints: {
      1024: {perView: 2},
      600: {perView: 1}
    }
  };
  new Glide('.glide', config).mount();
</script>

<script>
	let map;

  function initMap() {
    const mapOptions = {
      zoom: 15,
      center: { lat: <?php echo $house_data['lat'];?>, lng: <?php echo $house_data['lng'];?> },
    };
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    const marker = new google.maps.Marker({
      position: { lat: <?php echo $house_data['lat'];?>, lng: <?php echo $house_data['lng'];?> },
      map: map,
    });
    const infowindow = new google.maps.InfoWindow({
      content: "<p><?php
      echo $house_data['addressline1'];?>, <?php
      if($house_data['addressline2'] != NULL){
        echo $house_data['addressline2'];?>,<br><?php
      }
      if($house_data['addressline3'] != NULL){
        echo $house_data['addressline3'];?>, <?php
      }
      if($house_data['towncity'] != NULL){
        echo $house_data['towncity'];?>,<br><?php
      }
      if($house_data['county'] != NULL){
        echo $house_data['county'];?>, <?php
      }
      echo $house_data['postcode'];?></p>",
    });
    google.maps.event.addListener(marker, "click", () => {
      infowindow.open(map, marker);
    });
  }
</script>
