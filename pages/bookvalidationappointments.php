<?php
$CustomerAppointments = new Appointment($Conn);
$customer_appointments = $CustomerAppointments->getAllCustomerAppointments();
?>

<div class="container">
  <?php
  if($_POST){
    if($_POST['book_appointment']) {
        if(!$_POST['rentorsale']){
          $error = "Is the house for sale or for rent not set";
        }
        elseif(!$_POST['addressline1']){
          $error = "Address line 1 not set";
        }
        elseif(!$_POST['postcode']){
          $error = "Postcode not set";
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
        if(!$_POST['description']){
          $_POST['description'] = NULL;
        }

        if($error) {
        ?>
          <div class="alert alert-danger" role="alert">
              <?php echo $error; ?>
          </div>
        <?php
        }else{
          $attempt = $CustomerAppointments->submitAppointment($_POST);

          if($attempt) {
            ?>
                <div class="alert alert-success" role="alert">
                    You have made an appointment
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
      }
    elseif ($_POST['cancel_appointment']) {
      if($_POST['select_appointment'] == "none"){
        $error = "Appointment is not select";
      }

      if($error) {
      ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
      <?php
      }else{
        $attempt = $CustomerAppointments->removeAppointment($_POST);
        if($attempt) {
          ?>
              <div class="alert alert-success" role="alert">
                  Your appointment was cancelled.
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
    }
  }
  ?>
  <h1 class="mb-4 pb-2">Appointments</h1>
    <div class="row">
    <div class="col-md-12">
      <h2 class="mb-4 pb-2">Book an Appointment</h2>
      <form id="book-appointment" method="post" action="">

        <div class="form-group">
          <label for="rentorsale">Is the house for sale or for rent</label>
          <select class="form-control" id="rentorsale" name="rentorsale">
            <option value="none" selected disabled hidden>Select an option</option>
            <option value="sale">For Sale</option>
            <option value="rent">For Rent</option>
          </select>
        </div>

        <div class="form-group">
          <label for="addressline1">Address Line 1</label>
          <input type="text" class="form-control" id="addressline1" name="addressline1">
        </div>

        <div class="form-group">
          <label for="addressline2">Address Line 2</label>
          <input type="text" class="form-control" id="addressline2" name="addressline2">
        </div>

        <div class="form-group">
          <label for="addressline3">Address Line 3</label>
          <input type="text" class="form-control" id="addressline3" name="addressline3">
        </div>

        <div class="form-group">
          <label for="towncity">Town/City</label>
          <input type="text" class="form-control" id="towncity" name="towncity">
        </div>

        <div class="form-group">
          <label for="county">County</label>
          <input type="text" class="form-control" id="county" name="county">
        </div>

        <div class="form-group">
          <label for="postcode">Postcode</label>
          <input type="text" class="form-control" id="postcode" name="postcode">
        </div>

        <div class="form-group">
          <label for="property_type">Property type</label>
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
          </select>
        </div>

        <div class="form-group">
          <label for="bedrooms">Number of Bedrooms</label>
          <input type="number" class="form-control" id="bedrooms" name="bedrooms">
        </div>

        <div class="form-group">
          <label for="bathrooms">Number of Bathrooms</label>
          <input type="number" class="form-control" id="bathrooms" name="bathrooms">
        </div>

        <div class="form-group">
          <label for="garden">Garden Size (Acres)</label>
          <input type="number" class="form-control" id="garden" name="garden">
        </div>

        <div class="form-group">
          <label for="garage">Garage</label>
          <select class="form-control" id="garage" name="garage">
            <option value="none" selected disabled hidden>Select an option</option>
            <option value="true">Yes</option>
            <option value="false">No</option>
          </select>
        </div>

        <div class="form-group">
          <label for="description">Addtional Information (optional)</label>
          <input type="text" class="form-control" id="description" name="description">
        </div>

        <button type="submit" name="book_appointment" value="1" class="btn btn-easymove">Book appointment</button>

      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <h2 class="mb-4 pb-2">Cancel an Appointment</h2>
      <form id="cancel-appointment" method="post" action="">
        <div class="form-group">
          <label for="select_appointment">Select an appointment</label>
          <select class="form-control" id="select_appointment" name="select_appointment">
            <option value="none" selected disabled hidden>Select an Appointment</option>
            <?php foreach ($customer_appointments as $customer_appointment){?>
              <option value="<?php echo $customer_appointment['appointmentID']; ?>">
                Rent or Sale: <?php echo $customer_appointment['rentorsale'];?>, Address: <?php echo $customer_appointment['addressline1'];?>, <?php
                if($customer_appointment['addressline2'] != NULL){
                  echo $customer_appointment['addressline2']; ?>, <?php
                }
                if($customer_appointment['addressline3'] != NULL){
                  echo $customer_appointment['addressline3']; ?>, <?php
                }
                if($customer_appointment['towncity'] != NULL){
                  echo $customer_appointment['towncity']; ?>, <?php
                }
                if($customer_appointment['county'] != NULL){
                  echo $customer_appointment['county']; ?>, <?php
                }
                echo $customer_appointment['postcode'];?>
              </option>
            <?php } ?>
          </select>
        </div>
        <button type="submit" name="cancel_appointment" value="1" class="btn btn-easymove">Cancel appointment</button>
      </form>
    </div>
  </div>
</div>
