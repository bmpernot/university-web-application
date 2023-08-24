<?php
$Customer = new Customer($Conn);
$customers = $Customer->getAllCustomers();
?>

<div class="container">
  <h1 class="mb-4 pb-2">Add a new house for rent</h1>

  <?php
  if($_POST){
    if(!$_POST['addressline2']){
      $_POST['addressline2'] = NULL;
    }
    if(!$_POST['addressline3']){
      $_POST['addressline3'] = NULL;
    }
    if(!$_POST['towncity']){
      $_POST['towncity'] = NULL;
    }
    if(!$_POST['county']){
      $_POST['county'] = NULL;
    }
    if(!$_POST['landlordID']){
      $error = "Landlord/LandLady not set";
    }
    elseif(!$_POST['addressline1']){
      $error = "Address line 1 not set";
    }
    elseif(!$_POST['postcode']){
      $error = "Postcode not set";
    }
    elseif(!$_POST['lat']){
      $error = "Latitude not set";
    }
    elseif(!$_POST['lat']){
      $error = "Latitude not set";
    }
    elseif(!$_POST['lng']){
      $error = "Longitude must be between -90 and 90";
    }
    elseif(!$_POST['lng']){
      $error = "Longitude must be between -180 and 180";
    }
    elseif(!$_POST['property_type']){
      $error = "Property type not set";
    }
    elseif(!$_POST['bedrooms']){
      $error = "Bedrooms not set";
    }
    elseif(!$_POST['bathrooms']){
      $error = "Bathrooms not set";
    }
    elseif(!$_POST['garden']){
      $error = "Garden not set";
    }
    elseif(!$_POST['garage']){
      $error = "Garage not set";
    }
    elseif(!$_POST['price']){
      $error = "Avertised price not set";
    }
    elseif($_POST['price'] < 0){
      $error = "Avertised price cannot be less than 0";
    }
    elseif(!$_POST['propertydescription']){
      $error = "Property description value not set";
    }
    elseif(isset($_FILES['house_thumbnail'])) {
      $allowed_mime = array('image/gif','image/jpeg','image/png');
      if(!in_array($_FILES['house_thumbnail']['type'], $allowed_mime)) {
        $error = "Only GIF, JPG, JPEG and PNG files are allowed.";
      }
      elseif($_FILES['house_thumbnail']['size'] >= 2000000) {
        $error = "Only photos less than 2MBs are allowed";
      }
    }
    elseif(isset($_FILES['house_layout'])) {
      $allowed_mime = array('image/gif','image/jpeg','image/png');
      if(!in_array($_FILES['house_layout']['type'], $allowed_mime)) {
        $error = "Only GIF, JPG, JPEG and PNG files are allowed.";
      }
      elseif($_FILES['house_thumbnail']['size'] >= 2000000) {
        $error = "Only photos less than 2MBs are allowed";
      }
    }
    elseif(array_filter($_FILES['house_image'])) {
      foreach ($_FILES['house_image']['type'] as $house_image_type) {
        $allowed_mime = array('image/jpeg');
        if(!in_array($house_image_type, $allowed_mime)) {
            $error = "Only JPG and JPEG files are allowed.";
        }
      }
      foreach ($_FILES['house_image']['size'] as $house_image_size) {
        if($house_image_size >= 2000000) {
          $error = "Only photos less than 2MBs are allowed";
        }
      }
    }

    if($error) {
    ?>
      <div class="alert alert-danger" role="alert">
          <?php echo $error; ?>
      </div>
    <?php
    }else{
      $AddRent = new Add_Rent($Conn);
      $attempt = $AddRent->createHouse($_POST);

      $houseid = $AddRent->getHouseID($_POST);

      $random = substr(str_shuffle(MD5(microtime())), 0, 10);
      $new_filename = $random.$_FILES['house_thumbnail']['name'];
      if(move_uploaded_file($_FILES['house_thumbnail']['tmp_name'], __DIR__.'/../rent-images/'.$new_filename)){
        $AddRent->addHouseThumbnail($new_filename, $houseid);
      }else {
        echo '<div class="alert alert-danger">Thumbnail image did not upload</div>';
      }

      $random = substr(str_shuffle(MD5(microtime())), 0, 10);
      $new_filename = $random.$_FILES['house_layout']['name'];
      if(move_uploaded_file($_FILES['house_layout']['tmp_name'], __DIR__.'/../rent-images/'.$new_filename)){
        $AddRent->addHouseLayout($new_filename, $houseid);
      }else {
        echo '<div class="alert alert-danger">Layout image did not upload</div>';
      }

      foreach ($_FILES['house_image']['tmp_name'] as $house_image_tmp_name) {
        $random = substr(str_shuffle(MD5(microtime())), 0, 25);
        $random = $random.'.jpg';
        if(move_uploaded_file($house_image_tmp_name, __DIR__.'/../rent-images/'.$random)){
          $AddRent->addHouseImage($random, $houseid);
        } else {
          echo '<div class="alert alert-danger">Images did not upload</div>';
        }
      }

      if($attempt) {
        ?>
            <div class="alert alert-success" role="alert">
                New house has been added!
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
  } ?>

  <div class="row">
    <div class="col-md-12">
      <form id="reg-rent-form" method="post" action="" enctype="multipart/form-data">

        <div class="form-group">
          <label for="add_landlordID">Landlord/LandLady</label>
          <select class="form-control" id="add_landlordID" name="landlordID">
            <option value="none" selected disabled hidden>Select an option</option>
            <?php foreach($customers as $customer){ ?>
              <option value=<?php echo $customer['customerID'] ?>>
                <?php echo $customer['firstname']?> <?php echo $customer['lastname']?>
              </option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label for="add_addressline1">Address Line 1</label>
          <input type="text" class="form-control" id="add_addressline1" name="addressline1">
        </div>

        <div class="form-group">
          <label for="add_addressline2">Address Line 2</label>
          <input type="text" class="form-control" id="add_addressline2" name="addressline2">
        </div>

        <div class="form-group">
          <label for="add_addressline3">Address Line 3</label>
          <input type="text" class="form-control" id="add_addressline3" name="addressline3">
        </div>

        <div class="form-group">
          <label for="add_towncity">Town/City</label>
          <input type="text" class="form-control" id="add_towncity" name="towncity">
        </div>

        <div class="form-group">
          <label for="add_county">County</label>
          <input type="text" class="form-control" id="add_county" name="county">
        </div>

        <div class="form-group">
          <label for="add_postcode">Postcode</label>
          <input type="text" class="form-control" id="add_postcode" name="postcode">
        </div>

        <div class="form-group">
          <label for="add_lat">latitude</label>
          <input type="number" class="form-control" id="add_lat" name="lat" min="-90" max="90" step="0.00000001">
        </div>

        <div class="form-group">
          <label for="add_lng">longitude</label>
          <input type="number" class="form-control" id="add_lng" name="lng" min="-180" max="180" step="0.00000001">
        </div>

        <div class="form-group">
          <label for="add_property_type">Property type</label>
          <select class="form-control" id="add_property_type" name="property_type">
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
          </select>
        </div>

        <div class="form-group">
          <label for="add_bedrooms">Number of Bedrooms</label>
          <input type="number" class="form-control" id="add_bedrooms" name="bedrooms">
        </div>

        <div class="form-group">
          <label for="add_bathrooms">Number of Bathrooms</label>
          <input type="number" class="form-control" id="add_bathrooms" name="bathrooms">
        </div>

        <div class="form-group">
          <label for="add_garden">Garden Size (Acres)</label>
          <input type="number" class="form-control" id="add_garden" name="garden">
        </div>

        <div class="form-group">
          <label for="add_garage">Garage</label>
          <select class="form-control" id="add_garage" name="garage">
            <option value="none" selected disabled hidden>Select an option</option>
            <option value="true">Yes</option>
            <option value="false">No</option>
          </select>
        </div>

        <div class="form-group">
          <label for="add_price">Avertised Price (£)</label>
          <input type="number" class="form-control" id="add_price" name="price" min="0" step="0.01">
        </div>

        <div class="form-group">
          <label for="add_property_description">Property Description</label>
          <input type="text" class="form-control" id="add_property_description" name="propertydescription">
        </div>

        <div class="form-group">
          <label for="add_house_thumbnail">House Thumbnail</label>
          <input type="file" class="form-control-file" id="add_house_thumbnail" name="house_thumbnail">
        </div>

        <div class="form-group">
          <label for="add_house_image">House Images</label>
          <input type="file" class="form-control-file" id="add_house_image" name="house_image[]" multiple>
        </div>

        <div class="form-group">
          <label for="add_house_layout">House Layout</label>
          <input type="file" class="form-control-file" id="add_house_layout" name="house_layout">
        </div>

        <button type="submit" class="btn btn-easymove">Add House</button>

      </form>
    </div>
  </div>
</div>
