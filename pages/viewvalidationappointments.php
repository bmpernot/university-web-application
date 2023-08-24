<?php
$Appointment = new Appointment($Conn);
$appointments = $Appointment->viewAllAppointments();
?>

<div class="container">
  <h1 class="mb-4 pb-2">Appointment List</h1>
  <?php
  if($_POST){
    $attempt = $Appointment->completeAppointment($_POST);

    if($attempt) {
      ?>
          <div class="alert alert-success" role="alert">
              Customers appointment has been completed.
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
  <table class="table appointment-list-table">
    <thead>
      <tr>
        <th scope="col"><h5><strong>ID</strong></h5></th>
        <th scope="col"><h5><strong>Customer ID</strong></h5></th>
        <th scope="col"><h5><strong>First Name</strong></h5></th>
        <th scope="col"><h5><strong>Last Name</strong></h5></th>
        <th scope="col"><h5><strong>Email</strong></h5></th>
        <th scope="col"><h5><strong>Mobile</strong></h5></th>
        <th scope="col"><h5><strong>Rent or Sale</strong></h5></th>
        <th scope="col"><h5><strong>Address Line 1</strong></h5></th>
        <th scope="col"><h5><strong>Address Line 2</strong></h5></th>
        <th scope="col"><h5><strong>Address Line 3</strong></h5></th>
        <th scope="col"><h5><strong>Town/City</strong></h5></th>
        <th scope="col"><h5><strong>County</strong></h5></th>
        <th scope="col"><h5><strong>Postcode</strong></h5></th>
        <th scope="col"><h5><strong>Property Type</strong></h5></th>
        <th scope="col"><h5><strong>Bedrooms</strong></h5></th>
        <th scope="col"><h5><strong>Bathrooms</strong></h5></th>
        <th scope="col"><h5><strong>Garden Size</strong></h5></th>
        <th scope="col"><h5><strong>Garage</strong></h5></th>
        <th scope="col"><h5><strong>Addtional Information</strong></h5></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($appointments as $appointment) { ?>
        <tr>
          <th scope="row"><h6><?php echo $appointment['appointmentID']?></h6></th>
          <td><h6><?php echo $appointment['customerID']?></h6></td>
          <td><h6><?php echo $appointment['firstname']?></h6></td>
          <td><h6><?php echo $appointment['lastname']?></h6></td>
          <td><h6><?php echo $appointment['email']?></h6></td>
          <td><h6><?php echo $appointment['mobile']?></h6></td>
          <td><h6><?php echo $appointment['rentorsale']?></h6></td>
          <td><h6><?php echo $appointment['addressline1']?></h6></td>
          <td><h6><?php echo $appointment['addressline2']?></h6></td>
          <td><h6><?php echo $appointment['addressline3']?></h6></td>
          <td><h6><?php echo $appointment['towncity']?></h6></td>
          <td><h6><?php echo $appointment['county']?></h6></td>
          <td><h6><?php echo $appointment['postcode']?></h6></td>
          <td><h6><?php echo $appointment['propertytype']?></h6></td>
          <td><h6><?php echo $appointment['bedrooms']?></h6></td>
          <td><h6><?php echo $appointment['bathrooms']?></h6></td>
          <td><h6><?php echo $appointment['gardensize']?></h6></td>
          <td><h6><?php if($appointment['garage'] == 0){echo "No";}else{echo "Yes";}?></h6></td>
          <td><h6><?php echo $appointment['addtionalinformation']?></h6></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="row">
    <div class="col-md-12">
      <form id="appointment-completed-form" method="post" action="">
        <div class="form-group">
          <label for="appointmentid">Appointment ID</label>
          <select class="form-control" id="appointmentid" name="appointmentid">
            <option value="none" selected disabled hidden>Select an Option</option>
            <?php foreach ($appointments as $appointment) { ?>
                <option value="<?php echo $appointment['appointmentID']?>">
                  Appointment ID: <?php echo $appointment['appointmentID']?>
                </option>
              <?php } ?>
          </select>
        </div>
        <button type="submit" class="btn btn-easymove">Completed</button>
      </form>
    </div>
  </div>
</div>
