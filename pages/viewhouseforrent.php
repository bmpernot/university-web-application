<?php
$House = new House ($Conn);
$houses = $House->getHousesForRent();
?>
<div class="container">
  <h1 class="mb-4 pb-2">Houses for Rent</h1>
  <?php

  if($_POST['apply']){
  ?>
  <br>
  <?php
    if($_POST['min_price'] == "" && $_POST['max_price'] != ""){
      $_POST['min_price'] = 0;
    }
    if ($_POST['max_price'] == "" && $_POST['min_price'] != "") {
      $_POST['max_price'] = 999999999999999999999999999999;
    }
    if($_POST['min_price'] < 0){
      $_POST['min_price'] = 0;
    }
    if($_POST['max_price'] < 0){
      $_POST['max_price'] = 0;
    }
    if($_POST['min_price'] > $_POST['max_price']){
      $temp = $_POST['max_price'];
      $_POST['max_price'] = $_POST['min_price'];
      $_POST['min_price'] = $temp;
    }
    if ($_POST['bedrooms'] < 0){
      $_POST['bedrooms'] = 0;
    }
    if ($_POST['bathrooms'] < 0){
      $_POST['bathrooms'] = 0;
    }
    if($_POST['min_garden'] == "" && $_POST['max_garden'] != ""){
      $_POST['min_garden'] = 0;
    }
    if ($_POST['max_garden'] == "" && $_POST['min_garden'] != "") {
      $_POST['max_garden'] = 999999999999999999999999999999;
    }
    if($_POST['min_garden'] < 0){
      $_POST['min_garden'] = 0;
    }
    if($_POST['max_garden'] < 0){
      $_POST['max_garden'] = 0;
    }
    if($_POST['min_garden'] > $_POST['max_garden']){
      $temp = $_POST['max_garden'];
      $_POST['max_garden'] = $_POST['min_garden'];
      $_POST['min_garden'] = $temp;
    }
    if (!$_POST['garage']) {
      $_POST['garage'] = "none";
    }
    if (!$_POST['property_type']) {
      $_POST['property_type'] = "none";
    }
    if($_POST['min_date'] == "" && $_POST['max_date'] != ""){
      $_POST['min_date'] = "0001-01-01";
    }
    if ($_POST['max_date'] == "" && $_POST['min_date'] != "") {
      $_POST['max_date'] = date('Y-m-d');
    }
    if($_POST['min_date'] > $_POST['max_date']){
      $temp = $_POST['max_date'];
      $_POST['max_date'] = $_POST['min_date'];
      $_POST['min_date'] = $temp;
    }
    $houses = $House->getHousesForRentWithFiler($_POST);
  }
  ?>
  <div class="row">
    <div class="col-md-3">
    <form id="filters" method="post" action="">

      <div class="form-group">
        <label for="min_price">Price (PCM):</label>
        <input type="number" class="form-control" id="min_price" placeholder="Min" name="min_price" min="0">
        <input type="number" class="form-control" id="max_price" placeholder="Max" name="max_price" min="0">
      </div>

      <div class="form-group">
        <label for="bedrooms">Number of Bedrooms:</label>
        <input type="number" class="form-control" id="bedrooms" placeholder="No." name="bedrooms" min="0">
      </div>

      <div class="form-group">
        <label for="bathrooms">Number of Bathrooms:</label>
        <input type="number" class="form-control" id="bathrooms" placeholder="No." name="bathrooms" min="0">
      </div>

      <div class="form-group">
        <label>Garden Size (Acres):</label>
        <input type="number" class="form-control" id="min_garden" placeholder="Min" name="min_garden" min="0">
        <input type="number" class="form-control" id="max_garden" placeholder="Max" name="max_garden" min="0">
      </div>

      <div class="form-group">
        <label for="garage">Garage:</label>
        <select class="form-control" id="garage" name="garage">
          <option value="none" selected disabled hidden>Select an option</option>
          <option value=<?php echo true;?>>Yes</option>
          <option value=<?php echo false;?>>No</option>
          <option value="none">Do not mind</option>
        </select>
      </div>

      <div class="form-group">
        <label for="property_type">Property type:</label>
        <select class="form-control" id="property_type" name="property_type">
          <option value="none" selected disabled hidden>Select a property type</option>
          <option value="detached">Detached</option>
          <option value="semi-detached">Semi-Detached</option>
          <option value="terrace">Terrace</option>
          <option value="end-of-terrace">End of Terrace</option>
          <option value="flat">Flat</option>
          <option value="converted-flat">Converted Flat</option>
          <option value="split-level-flat">Split-Level Flat</option>
          <option value="studio-flat">Studio Flat</option>
          <option value="cottage">Cottage</option>
          <option value="bungalow">Bungalow</option>
          <option value="mansion">Mansion</option>
          <option value="conservation-property">Conservation Property</option>
          <option value="none">Do not mind</option>
        </select>
      </div>

      <div class="form-group">
        <label>When the property was added:</label>
        <br>
        <label for="min_date">Min:</label>
        <input class="float-right" type="date" id="min_date" name="min_date" min="2000-01-01" max="<?php echo date('Y-m-d');?>">
        <br>
        <label for="max_date">Max:</label>
        <input class="float-right" type="date" id="max_date" name="max_date" min="2000-01-01" max="<?php echo date('Y-m-d');?>">
      </div>

      <button type="submit" name="apply" value="1" class="btn btn-easymove float-right">Apply</button>
    </form>

    </div>
    <div class="col-md-9">
      <div class="row">
        <?php foreach($houses as $house) { ?>
        <div class="col-md-4">
          <div class="house-card">
            <div class="house-card-image" style="background-image: url('./rent-images/<?php echo $house['housethumbnail']; ?>')">
              <a href="index.php?p=houseforrent&id=<?php echo $house['houseforrentID']; ?>"></a>
            </div>
            <a href="index.php?p=houseforrent&id=<?php echo $house['houseforrentID']; ?>"><p>
               <?php echo $house['addressline1'];?>, <?php
               if($house['addressline2'] != NULL){
                 echo $house['addressline2'];?>,<br><?php
               }
               if($house['addressline3'] != NULL){
                 echo $house['addressline3'];?>, <?php
               }
               if($house['towncity'] != NULL){
                 echo $house['towncity'];?>,<br><?php
               }
               if($house['county'] != NULL){
                 echo $house['county'];?>, <?php
               }
               echo $house['postcode'];?>
            </p></a>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
